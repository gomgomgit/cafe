<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
    ];

    public function itemCount()
    {
        return $this->hasMany('App\Model\Item', 'category_id', 'id')->count();
    }

}
