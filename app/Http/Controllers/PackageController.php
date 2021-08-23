<?php

namespace App\Http\Controllers;

use App\HashedData;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shetabit\Multipay\Invoice;

class PackageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse|Response
     */
    public function index()
    {
        foreach (Package::all() as $pack) {
            create_hashed_data_if_not_exists($pack->id);
        }
        return view('packages.index', [
            'packages' => Package::all(),
        ]);
    }

    public function payment(Request $request)
    {
        $code = $request->get('code');

        $hashedData = HashedData::firstWhere('hashed', $code);
        if (!$hashedData) {
            abort(404);
            return '404';
        }

        $pack = Package::find($hashedData->data);
        if (!$pack) {
            abort(404);
            return '404';
        }
        return $pack->price;

        $amount = $pack->price;

        $email = Auth::user()->email;
        $mobile = Auth::user()->mobile;
        $user_id = Auth::user()->id;

        $invoice = new Invoice;
        $invoice->amount($amount);

        $invoice->detail('email', $email);
        $invoice->detail('mobile', $mobile);

        // Purchase method accepts a callback function.
        return \Shetabit\Payment\Facade\Payment::callbackUrl(route('payment.callback'))
            ->purchase($invoice, function ($driver, $transactionId) use ($email, $mobile, $user_id) {
                // We can store $transactionId in database.
                foreach (Auth::user()->carts as $cart) {
                    $amount = 0;
                    $item_type = 0;
                    $item_id = -1;
                    if ($cart->course) {
                        $amount = $cart->course->price;
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
    }

    public function redirect()
    {
        $amount = 0;
        foreach (Auth::user()->carts as $cart) {
            if ($cart->course)
                $amount += $cart->course->price;
            else
                $amount += $cart->learn_path->price();
        }
        $amount = check_off_for_user($amount);

        // $callback = route('payment.callback');
        // $description = 'lyndakade.ir';
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
        $status = 'موفق';
        $paymentMethod = 'پرداخت آنلاین زرین پال';
        try {
            $receipt = \Shetabit\Payment\Facade\Payment::amount(intval($amount))->transactionId($authority)->verify();
            $factorId = $receipt->getReferenceId();
            foreach (Auth::user()->carts as $cart) {
                if ($cart->learn_path) {
                    // foreach (js_to_courses($cart->learn_path->courses) as $course) {
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
                        'price' => check_off_for_user($cart->course->price),
                    ]);
                    $paid->save();
                }
            }

            Mail::to(Auth::user()->email)->send(new FactorMailer(Auth::user()->carts, $amount, $factorId, $status, $paymentMethod, $payments[0]->created_at, $authority));

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
