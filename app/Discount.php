<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['id', 'type', 'percent', 'start_date', 'end_date'];
}
