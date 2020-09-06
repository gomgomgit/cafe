<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'category_id', 'name', 'image', 'description',
    ];

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    public function detail()
    {
        return $this->hasMany('App\Model\ItemDetail');
    }
}
