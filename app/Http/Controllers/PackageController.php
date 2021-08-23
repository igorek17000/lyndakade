<?php

namespace App\Http\Controllers;

use App\HashedData;
use App\Mail\PackageFactorMailer;
use App\Package;
use App\Paid;
use App\Payment;
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
        // foreach ($packs as $pack) {
        //     create_hashed_data_if_not_exists($pack->id);
        // }

        return view('packages.index', [
            'packages' => $packs,
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

            // 

            // $user_paids = Paid::where('type', 3)->where('user_id', $payment->user->id)->get();
            // $last_paid = null;
            // if (count($user_paids) > 0) {
            //     $last_date = now()->subCentury();
            //     foreach ($user_paids as $user_paid) {
            //         if ($user_paid->start_date > $last_date) {
            //             $last_paid = $user_paid;
            //             $last_date = $user_paid->start_date;
            //         }
            //     }
            // }
            // if (!$last_paid)
            //     $start_date = now();
            // else
            //     $start_date = $last_paid; // + Package::find($last_paid->item_id)->days;

            $paid = new Paid([
                'factorId' => $factorId,
                'type' => 3,
                'item_id' => $payment->item_id,
                'user_id' => $payment->user->id,
                'price' => $amount,
            ]);
            $paid->save();

            Mail::to(Auth::user()->email)->send(new PackageFactorMailer($pack, $amount, $factorId, $status, $paymentMethod, $payment->created_at, $authority));

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
