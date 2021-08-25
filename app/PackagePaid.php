<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagePaid extends Model
{
    protected $fillable = ['id', 'user_id', 'count', 'end_date'];
}
