<?php

namespace App\Http\Controllers;

use App\Model\Ingredient;
use App\Model\Item;
use App\Model\ItemDetail;
use App\Model\Order;
use App\Model\OrderDetail;
use DataTables;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->model = new Order();
        $this->view = 'admin.orders.';
        $this->redirect = '/admin/orders';
        $this->name = 'orders';
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', $this->model);

        if ($request->ajax()) {
            $data = $this->model->orderBy('created_at', 'desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . $this->redirect . '/detail/' . $data->id . '" class="btn btn-sm btn-info"><i class="feather icon-info"></i>Detail</a>';
                    $button .= '<a href="' . $this->redirect . '/edit/' . $data->id . '" class="btn btn-sm btn-primary"><i class="feather icon-edit"></i>Edit</a>';
                    $button .= '<form class=" d-inline-block" method="post" action="' . $this->redirect . '/delete/' . $data->id . '">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button class="btn btn-sm btn-danger"><i class="feather icon-trash-2"></i>Delete</button>
                                </form>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->editColumn('user_id', function (Order $order) {
                    return $order->user->name;
                })
                ->editColumn('created_at', function (Order $order) {
                    return date('l d-M-Y', strtotime($order->created_at));
                })
                ->make(true);
        }

        return view($this->view . 'index');
    }

    public function detail($id)
    {
        $order = $this->model->find($id);
        $details = OrderDetail::where('order_id', $id)->get();
        return view('admin.orders.detail', compact('order', 'details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        $details = ItemDetail::with('variant')->with('size')->with('ingredients')->get();
        $ingredients = Ingredient::all();
        // dd($details->first());
        return view($this->view . 'create', compact('items', 'details', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer' => 'required',
            'total' => 'required',
            'itemdetail.*' => 'required',
            'qty.*' => 'required',
        ]);

        $order = $this->model->create([
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

        return redirect($this->redirect);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::with('orderDetails.itemDetail')->findOrFail($id);
        $items = Item::all();
        $details = ItemDetail::with('variant')->with('size')->get();
        // dd($order->orderDetails);
        return view($this->view . 'edit', compact('order', 'items', 'details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = $this->model->find($id);

        foreach ($order->orderDetails as $key => $orderDetail) {
            $detail = ItemDetail::with('ingredients')->find($orderDetail->item_detail_id);
            foreach ($detail->ingredients as $key => $ingredient) {
                $usedIngredient = Ingredient::find($ingredient->id);
                $stock = $ingredient->stock;
                $used = $ingredient->pivot->amount_ingredient * $orderDetail->qty;
                $nowStock = $stock + $used;
                $usedIngredient->update(['stock' => $nowStock]);
                // dd($usedIngredient);
            };
            // dd($orderDetail->qty);
        };

        // dd($order->orderDetails->first()->item_detail_id);
        // dd(Ingredient::find(1)->stock);

        $order->orderDetails()->delete();

        $this->validate($request, [
            'customer' => 'required',
            'total' => 'required',
            'itemdetail.*' => 'required',
            'qty.*' => 'required',
        ]);

        $order->update([
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
        };

        return redirect($this->redirect);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $order = $this->model->find($id);
        $order->orderDetails()->delete();
        $order->delete();

        return redirect()->back();
    }
}
