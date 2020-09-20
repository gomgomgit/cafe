<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Item;
use App\Model\ItemDetail;

// use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function shop()
    {
        $items = Item::all();
        $categories = Category::all();
        $details = ItemDetail::all();
        return view('home.shop', compact('items', 'categories', 'details'));
    }
}
