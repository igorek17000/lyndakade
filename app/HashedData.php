<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashedData extends Model
{
    protected $fillable = ['hashed', 'data'];
}
