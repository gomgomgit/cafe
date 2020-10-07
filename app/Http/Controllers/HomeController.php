<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\ingredient;
use App\Model\Item;
use App\Model\ItemDetail;
use App\Model\Order;
use Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $items = Item::all();
        // $categories = Category::all();
        $categories = Category::withCount('items')->get();
        $details = ItemDetail::all();
        return view('home.index', compact('items', 'categories', 'details'));
    }
    public function category($id)
    {
        $data = Category::find($id);
        $items = Item::where('category_id', $id)->get();
        $details = ItemDetail::all();
        return view('home.category', compact('data', 'items', 'details'));
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
        $this->validate($request, [
            'detailid' => 'required',
        ]);
        $cart = Cart::add($request->detailid, $request->item, $request->qty, $request->price, ['variant' => $request->vname, 'size' => $request->sname]);
        // $cart->associate('App\Model\ItemDetail');
        Cart::associate($cart->rowId, 'App\Model\ItemDetail');
        // dd(Cart::content()->first());

        // Cart::add('192ao12', 'Product 1', 1, 9.99);
        // dd($cart->model);
        return redirect(route('index'));
    }

    public function cart(Request $request)
    {
        // $carts = Cart::content()->associate('App\Model\ItemDetail');
        // foreach ($carts as $key => $value) {
        //     echo $value->model;
        // };
        $carts = Cart::content();
        return view('home.cart', compact('carts'));
    }

    public function order(Request $request)
    {
        $this->validate($request, [
            'customer' => 'required',
            'total' => 'required',
            'itemdetail.*' => 'required',
            'qty.*' => 'required',
            'item' => 'integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'customer' => $request->customer,
            'total' => $request->total,
        ]);

        for ($i = 0; $i < count($request->itemdetail); $i++) {
            $order->orderDetails()->create([
                'item_detail_id' => $request->itemdetail[$i],
                'qty' => $request->qty[$i],
                'sub_total' => $request->subtotal[$i],
            ]);
            $detail = ItemDetail::with('ingredients')->find($request->itemdetail[$i]);
            foreach ($detail->ingredients as $key => $ingredient) {
                $usedIngredient = Ingredient::find($ingredient->id);
                $stock = $ingredient->stock;
                $used = $ingredient->pivot->amount_ingredient * $request->qty[$i];
                $nowStock = $stock - $used;
                $usedIngredient->update(['stock' => $nowStock]);
                // dd($ingredient->stock);
            };
            // dd($detail->ingredients->first()->id);
        };

        Cart::destroy();
        return redirect(route('index'))->with('order', 'Pesanan Anda Sedang di Proses')->with('customer', 'Hai ' . $request->customer . ' !');
    }

    public function destroyCart()
    {
        Cart::destroy();
        $carts = Cart::content();
        return view('home.cart', compact('carts'));
    }
}
