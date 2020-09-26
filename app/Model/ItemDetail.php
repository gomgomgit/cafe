<?php

namespace App\Model;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model implements Buyable
{
    protected $fillable = [
        'item_id', 'variant_id', 'size_id', 'price',
    ];

    public function item()
    {
        return $this->belongsTo('App\Model\Item');
    }

    public function variant()
    {
        return $this->belongsTo('App\Model\Variant');
    }

    public function size()
    {
        return $this->belongsTo('App\Model\Size');
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\Model\Ingredient')->withPivot('amount_ingredient');
    }

    public function ingredient()
    {
        return $this->hasMany('App\Model\Ingredient');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\Model\OrderDetail', 'id');
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    public function getBuyableVariant($options = null)
    {
        return $this->variant_id;
    }

}
