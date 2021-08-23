<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PackagePaid extends Model
{
    public $fillable = ['id', 'user_id', 'days', 'count', 'start_date'];
}
