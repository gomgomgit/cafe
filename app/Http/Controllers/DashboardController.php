<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Item;
use App\Model\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        // $this->authorize('view', $this->model);
        $items = Item::with('ordered')->get();
        $itemName = Item::pluck('name');
        // $itemOrdered = Item::with('detail.orderDetails')->get();
        // $itemOrdered = $items->first()->ordered->sum('qty');
        // $itemOrdered = $items->pluck('ordered.qty');
        // $itemOrdered = $items->pluck('ordered')->collapse()->sum('qty');

        foreach ($items as $key => $item) {
            $itemOrdered[] = $item->ordered->sum('qty');
        }

        // dd($itemOrdered);

        // dd($itemOrdered->first()->ordered_count * $itemOrdered->first()->ordered()->qty);
        $categories = Category::all();
        $lastOrder = Order::latest()->take(5)->get();

        return view('admin.dashboard.index', compact('items', 'itemName', 'itemOrdered', 'categories', 'lastOrder'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
