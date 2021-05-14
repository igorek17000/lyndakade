<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paid extends Model
{
    protected $fillable = ['factorId', 'type', 'item_id', 'user_id', 'price'];
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
