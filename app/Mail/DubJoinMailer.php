<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DubJoinMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->name = $data->name;
        $this->email = $data->email;
        $this->phone = $data->phone;
        $this->gender = $data->gender;
        $this->skills = $data->skills;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('رزومه‌ی ' . ($this->gender == 'female' ? 'خانم ' : 'آقای ') . $this->name)
            ->view('emails.dub-join', [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'gender' => $this->gender,
                'skills' => $this->skills,
            ]);
    }
}
