<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Course;
use App\LearnPath;
use App\Mail\FactorMailer;
use App\Paid;
use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Shetabit\Multipay\Invoice;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return string
     * @throws Throwable
     */
    public function index(Request $request)
    {
        // list of cart items
        $user = User::find(Auth::id());
        $total_price = 0;
        foreach ($user->carts as $cart) {
            if ($cart->course) {
                $total_price += get_course_price($cart->course->price);
            } else if ($cart->learn_path) {
                $total_price += $cart->learn_path->price();
            }
        }

        $total_price = check_off_for_user($total_price);

        if ($request->ajax()) {
            $outputs = '';
            $outputs .= view('carts.partials._cart_list', [
                'carts' => $user->carts,
                'total_price' => $total_price,
            ]);
            return $outputs;
        }
        return view('carts.index', [
            'carts' => $user->carts,
            'total_price' => $total_price,
        ]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function add(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $cart = new Cart();
            $cart->user_id = Auth::id();
            $item = null;
            if ($id[0] == '1') {
                $item = Course::find(substr($id, 2));
                if ($this->isAdded($item->id))
                    return false;
                $cart->course()->associate($item);
            } else if ($id[0] == '2') {
                $item = LearnPath::find(substr($id, 2));
                if ($this->isAdded($item->id))
                    return false;
                $cart->learn_path()->associate($item);
            }
            if ($item == null)
                return false;
            $cart->item_id = $id;
            $cart->save();
            return true;
        }
        return false;
    }

    public function remove(Request $request)
    {
        if ($request->ajax()) {
            $item_id = $request->id;
            foreach (Cart::where('user_id', Auth::id())
                ->where('item_id', $item_id)->get() as $cart) {
                if ($cart) {
                    $cart->delete();
                    return true;
                }
            }
        }
        return false;
    }

    public function remove_all(Request $request)
    {
        if ($request->ajax()) {
            $user_id = Auth::id();
            foreach (Cart::where('user_id', $user_id)->get() as $cart) {
                if ($cart) {
                    $cart->delete();
                }
            }
            return true;
        }
        return false;
    }

    /**
     * @param $item_id
     * @return bool
     */
    public function isAdded($item_id)
    {
        if (Cart::where('user_id', Auth::id())->where('item_id', $item_id)->get()->isNotEmpty())
            return true;
        return false;
    }

    public function send_to_pay()
    {
        return view('carts.redirectForm', [
            'action' => route('payment.redirect'),
            'method' => 'post',
            'inputs' => [],
        ]);
    }

    public function redirect()
    {
        $amount = 0;
        $desc = '';
        $carts = Auth::user()->carts;
        foreach ($carts as $cart) {
            if ($cart->course) {
                $desc .= 'C' . $cart->course->id;
                $amount += get_course_price($cart->course->price);
            } else {
                $desc .= 'L' . $cart->learn_path->id;
                $amount += $cart->learn_path->price();
            }
            if ($carts->last() != $cart) {
                $desc .= '+';
            }
        }
        $amount = check_off_for_user($amount);

        // $callback = route('payment.callback');
        // $description = 'lyndakade.ir';
        $email = Auth::user()->email;
        $mobile = Auth::user()->mobile;
        $user_id = Auth::user()->id;

        $invoice = new Invoice;
        $invoice->amount($amount);

        $invoice->detail('email', $email);
        $invoice->detail('mobile', $mobile);
        $invoice->detail('description', '???????? ' . $desc);

        // Purchase method accepts a callback function.
        return \Shetabit\Payment\Facade\Payment::callbackUrl(route('payment.callback'))
            ->purchase($invoice, function ($driver, $transactionId) use ($email, $mobile, $user_id) {
                // We can store $transactionId in database.
                foreach (Auth::user()->carts as $cart) {
                    $amount = 0;
                    $item_type = 0;
                    $item_id = -1;
                    if ($cart->course) {
                        $amount = get_course_price($cart->course->price);
                        $item_type = 1;
                        $item_id = $cart->course->id;
                    } else {
                        $amount = $cart->learn_path->price();
                        $item_type = 2;
                        $item_id = $cart->learn_path->id;
                    }

                    $amount = check_off_for_user($amount);

                    $payment = new Payment([
                        'transactionId' => $transactionId,
                        'amount' => $amount,
                        'email' => $email,
                        'mobile' => $mobile,
                        'user_id' => $user_id,
                        'item_type' => $item_type,
                        'item_id' => $item_id,
                    ]);
                    $payment->save();
                }
            })->pay()->render();

        /*
        // $zarinpal = zarinpal()
        //     ->amount($amount)
        //     ->request()
        //     ->zarin()
        //     ->callback($callback)
        //     ->description($description)
        //     ->email($email)
        //     ->mobile($mobile)
        //     ->send();

        // if (!$zarinpal->success()) {
        //     return $zarinpal->error()->message();
        // }
        // $authority = $zarinpal->authority();

        // save to database
        // $payment = new Payment([
        //     'authority' => $authority,
        //     'amount' => $amount,
        //     'email' => $email,
        //     'mobile' => $mobile,
        //     'user_id' => Auth::user()->id,
        // ]);

        // $payment->save();

        // return $zarinpal->redirect();
*/
    }

    public function pay_callback()
    {
        // dd(request());

        $authority = request()->query('Authority');

        $payments = Payment::where('transactionId', $authority)->get();

        if (count($payments)  == 0) {
            return redirect()->route('root.home')->with('alerts', [
                'alert-type' => 'error',
                'message' => 'no payment found',
            ]);
        }
        $amount = 0;
        foreach ($payments as $payment) {
            $amount += $payment->amount;
        }

        if (!$amount) {
            return redirect()->route('root.home')->with('alerts', [
                'alert-type' => 'error',
                'message' => 'no price was entered!',
            ]);
        }

        // $response = zarinpal()
        //     ->amount($amount)
        //     ->verification()
        //     ->authority($authority)
        //     ->send();

        // if ($response->success()) {
        //     $factorId = $response->referenceId();
        //     foreach (Auth::user()->carts as $cart) {
        //         $paid = new Paid([
        //             'factorId' => $factorId,
        //             'type' => $cart->course ? 1 : 2,
        //             'item_id' => $cart->course ? $cart->course->id : $cart->learn_path->id,
        //             'user_id' => Auth::user()->id,
        //             'price' => $cart->course ? $cart->course->price : $cart->learn_path->price,
        //         ]);
        //         $paid->save();
        //         $cart->delete();
        //     }
        // }

        $factorId = -1;
        $status = '????????';
        $paymentMethod = '???????????? ???????????? ???????? ??????';
        try {
            $receipt = \Shetabit\Payment\Facade\Payment::amount(intval($amount))->transactionId($authority)->verify();
            $factorId = $receipt->getReferenceId();
            $isFirstPaid = Auth::user()->paids->count() == 0;
            foreach (Auth::user()->carts as $cart) {
                if ($cart->learn_path) {
                    // foreach (js_to_courses($cart->learn_path->_courses) as $course) {
                    //     $paid = new Paid([
                    //         'factorId' => $factorId,
                    //         'type' => 1,
                    //         'item_id' => $course->id,
                    //         'user_id' => $payment->user->id,
                    //         'price' => check_off_for_user($course->price),
                    //     ]);
                    //     $paid->save();
                    // }
                    $paid = new Paid([
                        'factorId' => $factorId,
                        'type' => 2,
                        'item_id' => $cart->learn_path->id,
                        'user_id' => $payments[0]->user->id,
                        'price' => check_off_for_user($cart->learn_path->price()),
                    ]);
                    $paid->save();
                } else {
                    $paid = new Paid([
                        'factorId' => $factorId,
                        'type' => 1,
                        'item_id' => $cart->course->id,
                        'user_id' => $payments[0]->user->id,
                        'price' => check_off_for_user(get_course_price($cart->course->price)),
                    ]);
                    $paid->save();
                }
            }

            Mail::to(Auth::user()->email)->send(new FactorMailer(Auth::user()->carts, $amount, $factorId, $status, $paymentMethod, $payments[0]->created_at, $authority, $isFirstPaid));

            foreach (Auth::user()->carts as $cart) {
                $cart->delete();
            }
            // echo $receipt->getReferenceId();
        } catch (InvalidPaymentException $exception) {
            $status = $exception->getMessage();
            // echo $exception->getMessage();
        }

        return view('carts.factor', [
            'referenceId' => $factorId,
            'total_price' => $amount,
            'date' => $payments[0]->created_at,
            'paymentMethod' => $paymentMethod,
            'paymentStatus' => $status,
            'paymentId' => $authority,
        ]);
    }
}
