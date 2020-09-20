<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'customer', 'total',
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\Model\OrderDetail');
    }
}
