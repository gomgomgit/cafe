<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Item;
use App\Model\ItemDetail;
use Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $items = Item::all();
        // $categories = Category::all();
        $categories = Category::withCount('items')->get();
        $details = ItemDetail::all();
        return view('home.index', compact('items', 'categories', 'details'));
    }

    public function shop()
    {
        $items = Item::all();
        $categories = Category::all();
        $details = ItemDetail::all();
        return view('home.shop', compact('items', 'categories', 'details'));
    }

    public function show($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        $details = ItemDetail::all();
        return view('home.item', compact('item', 'categories', 'details'));
    }

    public function addCart(Request $request)
    {
        // dd($request->item);
        $cart = Cart::add($request->detailid, $request->item, $request->qty, $request->price, ['variant' => $request->vname, 'size' => $request->sname]);
        // $cart->associate('App\Model\ItemDetail');
        $cart->associate($cart->rowId, 'App\Model\ItemDetail');
        // dd(Cart::content()->first());

        // Cart::add('192ao12', 'Product 1', 1, 9.99);
        dd($cart);
        return redirect(route('index'));
    }

    public function cart(Request $request)
    {
        // $carts = Cart::content()->associate('App\Model\ItemDetail');
        foreach ($carts as $key => $value) {
            echo $value->model;
        };
        $carts = Cart::content();
        return view('home.cart', compact('carts'));
    }

    public function destroyCart()
    {
        Cart::destroy();
        $carts = Cart::content();
        return view('home.cart', compact('carts'));
    }
}
