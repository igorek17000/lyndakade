<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnlockedCourse extends Model
{
    protected $fillable = ['id', 'user_id', 'course_id', 'learn_path_id'];
}
