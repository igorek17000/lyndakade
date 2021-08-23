<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PackageFactorMailer extends Mailable
{
    use Queueable, SerializesModels;
    public $pack, $amount, $factorId, $status, $paymentMethod, $created_date, $authority;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pack, $amount, $factorId, $status, $paymentMethod, $created_date, $paymentId)
    {
        $this->pack = $pack;
        $this->amount = $amount;
        $this->factorId = $factorId;
        $this->status = $status;
        $this->paymentMethod = $paymentMethod;
        $this->created_date = $created_date;
        $this->paymentId = $paymentId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('خرید پکیج با موفقیت انجام شد.')
            ->view('emails.package-factor', [
                'date' => $this->created_date,
                'package' => $this->pack,
                'amount' => $this->amount,
                'factorId' => $this->factorId,
                'status' => $this->status,
                'paymentMethod' => $this->paymentMethod,
                'paymentId' => $this->paymentId,
            ]);
    }
}
