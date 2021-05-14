<?php

namespace App\Mail;

use App\Course;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseAdded extends Mailable
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
        return $this->subject('دوره آموزشی درخواست شده در وبسایت لینداکده ثبت شده است')
            ->view('emails.course-added-to-demand-users', [
                'course' => $this->course,
            ]);
    }
}
