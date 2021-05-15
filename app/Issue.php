<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['text', 'type'];
    // protected $with = ['course'];

    /**
     * A Demand belong to a Course
     *
     * @return BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
