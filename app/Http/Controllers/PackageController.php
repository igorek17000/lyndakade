<?php

namespace App\Http\Controllers;

use App\HashedData;
use App\Mail\PackageFactorMailer;
use App\Package;
use App\PackagePaid;
use App\Paid;
use App\Payment;
use App\UnlockedCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
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
        $packs = Package::get();
        foreach ($packs as $pack) {
            create_hashed_data_if_not_exists($pack->id);
        }

        return view('packages.index', [
            'packages' => $packs,
        ]);
    }

    public function unlock_courses(Request $request)
    {
        $user_id = auth()->id();
        $carts = auth()->user()->carts;
        $count = 0;

        foreach ($carts as $cart) {
            if ($cart->course) {
                $count += 1;
            } else {
                foreach (js_to_courses($cart->learn_path->_courses) as $current_course) {
                    $count += 1;
                }
            }
        }
        if ($count == 0) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'هیچ دوره آموزشی ای انتخاب نشده است.');
        }

        if (number_of_available_package($user_id) >= $count) {
            // submit the courses in UnlockCourses
            foreach ($carts as $cart) {
                if ($cart->course) {
                    if (UnlockedCourse::where('user_id', $user_id)->where('course_id', $cart->course->id)->first())
                        continue;
                    $unlock_course = new UnlockedCourse([
                        'user_id' => $user_id,
                        'course_id' => $cart->course->id,
                    ]);
                    $unlock_course->save();
                } else {
                    if (UnlockedCourse::where('user_id', $user_id)->where('learn_path_id', $cart->learn_path->id)->first())
                        continue;

                    $unlock_course = new UnlockedCourse([
                        'user_id' => $user_id,
                        'learn_path_id' => $cart->learn_path->id,
                    ]);
                    $unlock_course->save();
                }
                $cart->delete();
            }

            PackagePaid::where('user_id', $user_id)->update([
                'count' => PackagePaid::where('user_id', $user_id)->first()->count - $count,
            ]);

            return redirect()
                ->route('courses.mycourses')
                ->with('message', 'دوره های آموزشی مورد نظر باز شده اند.');
        } else {
            return redirect()
                ->route('packages.index')
                ->with('error', 'اعتبار اشتراک کافی نمیباشد.');
        }
    }

    public function payment(Request $request)
    {
        $code = $request->get('code');

        $hashedData = HashedData::firstWhere('hashed', $code);
        if (!$hashedData) {
            return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
            abort(404);
            return '404';
        }

        $pack = Package::find($hashedData->data);
        if (!$pack) {
            return redirect()->route('root.home')->with('error', 'صفحه مورد نظر یافت نشد.');
            abort(404);
            return '404';
        }

        $amount = $pack->price;

        $email = Auth::user()->email;
        $mobile = Auth::user()->mobile;
        $user_id = Auth::user()->id;

        $invoice = new Invoice;
        $invoice->amount($amount);

        $invoice->detail('email', $email);
        $invoice->detail('mobile', $mobile);

        // Purchase method accepts a callback function.
        return \Shetabit\Payment\Facade\Payment::callbackUrl(route('packages.callback'))
            ->purchase($invoice, function ($driver, $transactionId) use ($email, $mobile, $user_id, $amount, $pack) {

                // We can store $transactionId in database.
                $payment = new Payment([
                    'transactionId' => $transactionId,
                    'amount' => $amount,
                    'email' => $email,
                    'mobile' => $mobile,
                    'user_id' => $user_id,
                    'item_type' => "3",
                    'item_id' => $pack->id,
                ]);
                $payment->save();
            })->pay()->render();
    }

    public function callback()
    {
        $authority = request()->query('Authority');

        $payment = Payment::firstWhere('transactionId', $authority);

        if (!$payment) {
            return redirect()->route('root.home')->with('alerts', [
                'alert-type' => 'error',
                'message' => 'no payment found',
            ]);
        }
        $amount = $payment->amount;

        if (!$amount) {
            return redirect()->route('root.home')->with('alerts', [
                'alert-type' => 'error',
                'message' => 'no price was entered!',
            ]);
        }

        $factorId = -1;
        $status = 'موفق';
        $paymentMethod = 'پرداخت آنلاین زرین پال';
        try {
            $receipt = \Shetabit\Payment\Facade\Payment::amount(intval($amount))->transactionId($authority)->verify();
            $factorId = $receipt->getReferenceId();
            $pack = Package::find($payment->item_id);

            $user_package_paid = PackagePaid::where('user_id', $payment->user->id)->first();

            if ($user_package_paid) {
                $end_date = Carbon::createFromTimestamp(strtotime($user_package_paid->end_date))
                    ->addDays($pack->days);
                if (Carbon::createFromTimestamp(strtotime($user_package_paid->end_date)) >= now()) {
                    $count = $user_package_paid->count;
                } else {
                    $count = 0;
                    $end_date = now()->addDays($pack->days);
                }
                PackagePaid::where('user_id', $payment->user->id)
                    ->update([
                        'end_date' => $end_date,
                        'count' => $count + $pack->count,
                    ]);
            } else {
                $end_date = now()->addDays($pack->days);
                $package_paid = new PackagePaid([
                    'user_id' => $payment->user->id,
                    'count' => $pack->count,
                    'end_date' => $end_date,
                ]);
                $package_paid->save();
            }

            $paid = new Paid([
                'factorId' => $factorId,
                'type' => 3,
                'item_id' => $payment->item_id,
                'user_id' => $payment->user->id,
                'price' => $amount,
            ]);
            $paid->save();

            Mail::to(Auth::user()->email)->send(new PackageFactorMailer($pack, $amount, $factorId, $status, $paymentMethod, $payment->created_at, $authority, $end_date));

            // echo $receipt->getReferenceId();
        } catch (InvalidPaymentException $exception) {
            $status = $exception->getMessage();
            // echo $exception->getMessage();
        }

        return view('carts.factor', [
            'referenceId' => $factorId,
            'total_price' => $amount,
            'date' => $payment->created_at,
            'paymentMethod' => $paymentMethod,
            'paymentStatus' => $status,
            'paymentId' => $authority,
        ]);
    }
}
