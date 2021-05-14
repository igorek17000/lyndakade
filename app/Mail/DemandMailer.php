<?php

namespace App\Mail;

use App\Demand;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * @param Demand
     * @return void
     */
    public function __construct(Demand $demand, User $user = null)
    {
        $this->user = $user;
        $this->demand = $demand;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (!$this->user)
            return $this->subject('new course request ON www.LyndaKade.ir')
                ->view('emails.demands', ['demand' => $this->demand]);

        return $this->subject('Your Course Request ON www.LyndaKade.ir')
            ->view('emails.demandsToUser', ['demand' => $this->demand, 'user' => $this->user]);
    }
}
