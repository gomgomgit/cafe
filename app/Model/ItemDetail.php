<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    protected $fillable = [
        'item_id', 'variant_id', 'size_id', 'price',
    ];

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

}
