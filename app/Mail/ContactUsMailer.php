<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $message, $type)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('A new message from contact us Lyndakade.ir')
            ->view('emails.contact-us', [
                'name' => $this->name,
                'email' => $this->email,
                'msg' => $this->message,
                'type' => $this->type,
            ]);
    }
}
