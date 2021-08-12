<?php

namespace App\Mail;

use App\LearnPath;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LearnPathAdded extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LearnPath $path)
    {
        $this->path = $path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('مسیر آموزشی درخواست شده در وبسایت لینداکده ثبت شده است')
            ->view('emails.path-added-to-demand-users', [
                'path' => $this->path,
            ]);
    }
}
