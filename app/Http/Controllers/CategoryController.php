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
        $this->authorize('viewAny', $this->model);

        if ($request->ajax()) {
            $data = $this->model->all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . $this->redirect . '/edit/' . $data->id . '" class="btn btn-sm btn-primary"><i class="feather icon-edit"></i>Edit</a>';
                    $button .= '<form class=" d-inline-block" method="post" action="' . $this->redirect . '/delete/' . $data->id . '">
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
        $this->authorize('create', $this->model);
        return view($this->view . 'create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', $this->model);
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
        $this->authorize('update', $data);

        return view($this->view . "edit", compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->model->find($id);

        $this->authorize('update', $data);

        $this->validate($request, [
            'name' => 'required|unique:' . $this->name . ',name,' . $id,
        ]);

        $data->name = $request->name;
        $data->save();

        return redirect($this->redirect);
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        $this->authorize('delete', $model);

        Item::where('category_id', $id)->update([
            'category_id' => 1,
        ]);

        $model->delete();
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
        $this->model->onlyTrashed()->where('id', $id)->restore();

        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $this->model->onlyTrashed()->where('id', $id)->forceDelete();

        return redirect()->back();
    }
}
