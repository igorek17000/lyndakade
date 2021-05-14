<?php

namespace App\Mail;

use App\Course;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseUpdatedMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('دوره آموزشی خریداری شده در وبسایت لینداکده بروزرسانی شده است')
            ->view('emails.course-updated-to-paid-users', [
                'course' => $this->course
            ]);
    }
}
