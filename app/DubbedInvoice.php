<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DubbedInvoice extends Model
{

    protected $fillable = ['id', 'user_id', 'price'];
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
