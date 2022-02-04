<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DubbedCourseUser extends Pivot
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
