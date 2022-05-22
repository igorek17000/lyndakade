<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DubbedCourseFactor extends Model
{

    protected $fillable = ['id', 'course_id', 'start_date', 'end_date', 'total_minutes', 'user_id'];
    // protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
