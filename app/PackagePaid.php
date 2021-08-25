<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagePaid extends Model
{
    protected $fillable = ['id', 'user_id', 'count', 'start_date', 'end_date'];
}
