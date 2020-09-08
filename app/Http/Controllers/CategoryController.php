<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Item;
use DataTables;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->model = new Category();
        $this->view = 'admin.categories.';
        $this->redirect = '/admin/categories';
        $this->name = 'categories';
    }

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
                ->rawColumns(['action'])
                ->make(true);
        }

        return view($this->view . 'index');
    }

    public function create()
    {
        return view($this->view . 'create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:' . $this->name . ',name,',
        ]);

        $this->model->create([
            'name' => $request->name,
        ]);

        return redirect($this->redirect);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = $this->model->find($id);

        return view($this->view . "edit", compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:' . $this->name . ',name,' . $id,
        ]);

        $data = $this->model->find($id);
        $data->name = $request->name;
        $data->save();

        return redirect($this->redirect);
    }

    public function delete($id)
    {
        $model = $this->model->find($id);

        Item::where('category_id', '$id')->update([
            'category_id' => 1,
        ]);

        $model->delete();
        return redirect($this->redirect);

    }
}
