<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['transactionId', 'amount', 'email', 'mobile', 'user_id', 'item_type', 'item_id'];
    // protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
