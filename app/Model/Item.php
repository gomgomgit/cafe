<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'category_id', 'name', 'image', 'description',
    ];

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    public function detail()
    {
        return $this->hasMany('App\Model\ItemDetail', 'item_id', 'id');
    }

    public function ordered()
    {
        return $this->hasManyThrough('App\Model\OrderDetail', 'App\Model\ItemDetail');
    }
}
