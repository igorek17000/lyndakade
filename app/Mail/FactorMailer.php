<?php

namespace App\Mail;

use App\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FactorMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $carts;
    public $amount;
    public $factorId;
    public $status;
    public $paymentMethod;
    public $date;
    public $paymentId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($carts, $amount, $factorId, $status, $paymentMethod, $date, $paymentId)
    {
        $this->carts = $carts;
        $this->amount = $amount;
        $this->factorId = $factorId;
        $this->status = $status;
        $this->paymentMethod = $paymentMethod;
        $this->date = $date;
        $this->paymentId = $paymentId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $courses = [];
        $paths = [];
        foreach ($this->carts as $cart) {
            if ($cart->course) {
                $courses[] = $cart->course;
            } else {
                $paths[] = $cart->learn_path;
            }
        }
        return $this->subject('خرید شما با موفقیت انجام شد.')
            ->view('emails.factor', [
                'courses' => $courses,
                'date' => $this->date,
                'paths' => $paths,
                'amount' => $this->amount,
                'factorId' => $this->factorId,
                'status' => $this->status,
                'paymentMethod' => $this->paymentMethod,
                'paymentId' => $this->paymentId,
            ]);
    }
}
