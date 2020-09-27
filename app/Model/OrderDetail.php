<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id', 'item_detail_id', 'qty', 'sub_total',
    ];

    public function itemDetail()
    {
        return $this->belongsTo('App\Model\ItemDetail')->withTrashed();
    }
}
