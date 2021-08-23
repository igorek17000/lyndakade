<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['id', 'title', 'days', 'count', 'price',];
}
