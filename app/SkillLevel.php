<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SkillLevel extends Model
{
    /**
     * A SkillLevel can have many Courses
     *
     */
    public function courses()
    {
        // return Course::where('skillLevel', $this->id)->get();
        return $this->hasMany(Course::class);
    }
}
