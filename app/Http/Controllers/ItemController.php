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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->model = new Item();
        $this->view = 'admin.items.';
        $this->redirect = '/admin/items';
        $this->name = 'items';
        $this->imgDir = public_path('image');
    }
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->model);

        if ($request->ajax()) {
            $data = $this->model->all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . $this->redirect . '/detail/' . $data->id . '" class="btn btn-sm btn-info"><i class="feather icon-info"></i>Detail</a>';
                    // $button .= '<a href="' . $this->name . '/choose-edit/' . $data->id . '" class="btn btn-sm btn-primary"><i class="feather icon-edit"></i>Edit</a>';
                    $button .= '<form class=" d-inline-block" method="post" action="' . $this->redirect . '/delete/' . $data->id . '">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button class="btn btn-sm btn-danger"><i class="feather icon-trash-2"></i>Delete</button>
                                </form>';

                    return $button;
                })
                ->addColumn('variants', function ($data) {
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
                ->rawColumns(['action', 'variants', 'size'])
                ->editColumn('category_id', function (Item $item) {
                    return $item->category->name;
                })
                ->make(true);
        }

        return view($this->view . 'index');
    }
    public function create()
    {
        $this->authorize('create', $this->model);

        $categories = Category::all();
        $variants = Variant::all();
        $sizes = Size::all();
        $ingredients = Ingredient::all();
        return view($this->view . 'create', compact('categories', 'variants', 'sizes', 'ingredients'));
    }
    public function createDetail(Request $request)
    {
        $this->authorize('create', $this->model);
        $request->validate([
            'name' => 'required|unique:' . $this->name . ',name',
            'category_id' => 'required',
            'variants' => 'required',
            'sizes' => 'required',
        ]);

        $data = $request;
        return view($this->view . 'createDetail', compact('data'));
    }
    public function store(Request $request)
    {
        $this->authorize('create', $this->model);
        $request->validate([
            'name' => 'required|unique:' . $this->name . ',name',
            'category_id' => 'required',
            'variant' => 'required',
            'size' => 'required',
            'price' => 'required',
            'ingredientId' => 'required',
            'ingredientQty' => 'required',
        ]);

        if ($request->image_file) {
            $request = $this->storeImage($request);
        } else {
            $request->merge([
                'image' => 'coffee.jpg',
            ]);
        }

        $item = Item::create($request->all());

        $ingredients = 0;

        for ($i = 0; $i < $request->detailCount; $i++) {
            $detail = ItemDetail::create([
                'item_id' => $item->id,
                'variant_id' => $request->variant[$i],
                'size_id' => $request->size[$i],
                'price' => $request->price[$i],
            ]);

            for ($j = 0; $j < $request->ingredientSelected; $j++) {
                $ingredientId[] = $request->ingredientId[$ingredients];
                $ingredientQty[] = $request->ingredientQty[$ingredients];
                $ingredients++;
            };

            // dd($ingredientId);

            // $extra = array_map(function ($key) use ($ingredientQty) {
            //     $index = $key - 1;
            //     $qty = $ingredientQty[$index];
            //     return ['amount_ingredient' => $qty];
            // }, $ingredientId);

            $extra = array_map(function ($value) {
                return ["amount_ingredient" => $value];
            }, $ingredientQty);

            // dd($extra);

            $ingredientSync = array_combine($ingredientId, $extra);

            // dd($ingredientSync);

            // foreach ($ingredientId as $key => $id) {
            //     $ingredientSync[$id] = ["amount_ingredient" => $ingredientQty[$key]];
            // };

            // $ingredientId = array(2,3);
            // $ingredientQty = array(34,56);

            // $detail->ingredients()->sync([2 => ["amount" => 34], 3 => ["amount" => 56]]);

            foreach ($ingredientSync as $key => $value) {
                // dd($value);
                $detail->ingredients()->sync([$key => $value], false);
            }

            // $detail->ingredients()->sync($ingredientSync);

            unset($ingredientId, $ingredientQty, $ingredientSync);

            // $ingredientId[] = null;
            // $ingredientQty[] = null;
            // $ingredientSync[] = null;

        }

        return redirect($this->redirect);
    }
    public function detail($id)
    {
        $this->authorize('view', $this->model);
        $data = $this->model->find($id);
        $details = ItemDetail::where('item_id', $id)->get();
        return view($this->view . 'detail', compact('data', 'details'));
    }
    public function editItem($id)
    {
        $data = $this->model->find($id);
        $this->authorize('update', $data);

        $details = ItemDetail::where('item_id', $id)->get();
        $categories = Category::all();
        return view('admin.items.editItem', compact('data', 'details', 'categories'));
    }
    public function editDetail($id)
    {
        $data = ItemDetail::find($id);
        $item = $this->model->find($data->item_id);
        // dd($item);
        $this->authorize('update', $item);
        return view('admin.items.editDetail', compact('data'));
    }
    public function editOption($id)
    {
        $data = $this->model->find($id);
        $this->authorize('update', $data);
        $details = ItemDetail::where('item_id', $data->id)->get();
        // dd($details->first()->ingredients());
        $categories = Category::all();
        $variants = Variant::all();
        $sizes = Size::all();
        $ingredients = Ingredient::all();

        return view('admin.items.editOption', compact('data', 'categories', 'details', 'variants', 'sizes', 'ingredients'));
    }
    public function editDetailOption(Request $request, $id)
    {

        $data = $request;

        $item = $this->model->find($id);

        $this->authorize('update', $item);

        $request->validate([
            'name' => 'required|unique:' . $this->name . ',name,' . $id,
            'category_id' => 'required',
            'variants' => 'required',
            'sizes' => 'required',
        ]);
        $dbItemDetail = new ItemDetail();
        $dbVariant = new Variant();
        $dbSize = new Size();
        $dbIngredient = new Ingredient();
        return view($this->view . 'editDetailOption', compact('data', 'item', 'dbItemDetail', 'dbVariant', 'dbSize', 'dbIngredient'));
    }
    public function updateItem(Request $request, $id)
    {
        $data = $this->model->find($id);
        $this->authorize('update', $data);

        if ($request->image_file) {
            $this->removeImage($data->image);
            $request = $this->storeImage($request);
        }

        $details = ItemDetail::where('item_id', $id)->get();

        $data->name = $request->name;
        $data->category_id = $request->category_id;
        $data->image = $request->image;
        if ($request->description) {
            $data->description = $request->description;
        }
        $data->save();
        return view($this->view . 'detail', compact('data', 'details'));

    }
    public function updateDetail(Request $request, $id)
    {
        $data = ItemDetail::find($id);
        $this->authorize('update', $data);

        $request->validate([
            'price' => 'required',
        ]);

        $data->price = $request->price;
        $data->save();
        // return view($this->view . 'detail', compact('data', 'details'));
        $item_id = $data->item_id;
        return redirect('/admin/items/detail/' . $item_id);

    }
    public function updateDetailOption(Request $request, $id)
    {
        $model = Item::find($id);

        $this->authorize('update', $model);

        $request->validate([
            'name' => 'required|unique:' . $this->name . ',name,' . $id,
            'category_id' => 'required',
            'variant' => 'required',
            'size' => 'required',
            'price' => 'required',
            'ingredientId' => 'required',
            'ingredientQty' => 'required',
        ]);

        // Image file

        // if ($request->image_file) {
        //     $this->removeImage($data->image);
        //     $request = $this->storeImage($request);
        // }

        $item = $model->update($request->all());

        $ingredients = 0;

        $itemDetails = ItemDetail::where('item_id', $id)->get();
        // $itemDetails->delete();
        foreach ($itemDetails as $key => $itemDetail) {
            //     $itemDetail->ingredients()->detach();
            DB::table('ingredient_item_detail')->where('item_detail_id', $itemDetail->id)->delete();
            $itemDetail->delete();
        }

        for ($i = 0; $i < $request->detailCount; $i++) {
            $detail = ItemDetail::updateOrCreate([
                'item_id' => $id,
                'variant_id' => $request->variant[$i],
                'size_id' => $request->size[$i],
                'price' => $request->price[$i],
            ]);

            for ($j = 0; $j < $request->ingredientSelected; $j++) {
                $ingredientId[] = $request->ingredientId[$ingredients];
                $ingredientQty[] = $request->ingredientQty[$ingredients];
                $ingredients++;
            };

            $extra = array_map(function ($value) {
                return ["amount_ingredient" => $value];
            }, $ingredientQty);

            $ingredientSync = array_combine($ingredientId, $extra);

            foreach ($ingredientSync as $key => $value) {
                $detail->ingredients()->sync([$key => $value], false);
            }

            unset($ingredientId, $ingredientQty, $ingredientSync);

        }

        return redirect('/admin/items/detail/' . $id);
    }

    public function storeImage($request)
    {
        $img = $request->file('image_file');
        $newName = Str::camel($request->name) . time() . '.' . $img->getClientOriginalExtension();

        $img->move($this->imgDir, $newName);
        $request->merge([
            'image' => $newName,
        ]);
        return $request;
    }

    public function removeImage($image)
    {
        $imagePath = $this->imgDir . '/' . $image;

        if ($image != 'coffee.jpg' && file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        $this->authorize('update', $model);

        $this->removeImage($model->image);

        $model->delete();
        ItemDetail::where('item_id', '$id')->delete();
        return redirect($this->redirect);
    }

    public function trash(Request $request)
    {
        $this->authorize('update', $this->model);

        if ($request->ajax()) {
            $data = $this->model->onlyTrashed()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . $this->redirect . '/restore/' . $data->id . '" class="btn btn-sm btn-primary"><i class="feather icon-corner-down-left"></i>Restore</a>';
                    $button .= '<form class=" d-inline-block" method="post" action="' . $this->redirect . '/force-delete/' . $data->id . '">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button class="btn btn-sm btn-danger"><i class="feather icon-trash-2"></i>Force Delete</button>
                                </form>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view($this->view . 'trash');

    }

    public function restore($id)
    {
        $this->authorize('update', $this->model);
        $this->model->onlyTrashed()->find($id)->restore();

        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $this->model->onlyTrashed()->find($id)->forceDelete();

        return redirect()->back();
    }
}
