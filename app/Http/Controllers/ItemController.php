<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Ingredient;
use App\Model\Item;
use App\Model\ItemDetail;
use App\Model\Size;
use App\Model\Variant;
use DataTables;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->model = new Item();
        $this->view = 'admin.items.';
        $this->redirect = '/admin/items';
        $this->name = 'items';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = $this->model->all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . $this->name . '/edit/' . $data->id . '" class="btn btn-sm btn-primary"><i class="feather icon-edit"></i>Edit</a>';
                    $button .= '<form class=" d-inline-block" method="post" action="' . $this->name . '/delete/' . $data->id . '">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button class="btn btn-sm btn-danger"><i class="feather icon-trash-2"></i>Delete</button>
                                </form>';

                    return $button;
                })
                ->addColumn('variant', function ($data) {
                    $variants = [];
                    foreach ($data->detail as $key => $detail) {
                        array_push($variants, $detail->variant->name);
                    };
                    return $variants;
                })
                ->addColumn('size', function ($data) {
                    $sizes = [];
                    foreach ($data->detail as $key => $detail) {
                        array_push($sizes, $detail->size->name);
                    };
                    return $sizes;
                })
                ->rawColumns(['action', 'variant', 'size'])
                ->editColumn('category_id', function (Item $item) {
                    return $item->category->name;
                })
                ->make(true);
        }

        return view($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $variants = Variant::all();
        $sizes = Size::all();
        $ingredients = Ingredient::all();
        return view($this->view . 'create', compact('categories', 'variants', 'ingredients', 'sizes'));
    }
    public function createDetail(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:' . $this->name . ',name',
            'category_id' => 'required',
            'variants' => 'required',
            'sizes' => 'required',
        ]);

        $data = $request;
        return view($this->view . 'createDetail', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:' . $this->name . ',name',
            'category_id' => 'required',
            'variants' => 'required',
            'sizes' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->model->find($id)->delete();
        ItemDetail::where('item_id', '$id')->delete();
        return redirect($this->redirect);
    }
}
