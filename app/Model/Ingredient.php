<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name', 'stock',
    ];

    public function itemdetails()
    {
        $this->belongsToMany('App\Model\ItemDetail')->withPivot('amount_ingredient');
    }
}
