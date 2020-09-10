<?php

namespace App\Http\Controllers;

use App\Model\Ingredient;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->model = new Ingredient();
        $this->view = 'admin.ingredients.';
        $this->redirect = '/admin/ingredients';
        $this->name = 'ingredients';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->model);

        if ($request->ajax()) {
            $data = $this->model->all();

            return DataTables::of($data)
                ->editColumn('stock', function (Ingredient $ingredients) {
                    return $ingredients->stock . ' gr/ml';
                })
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $this->model);
        return view($this->view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', $this->model);
        $this->validate($request, [
            'name' => 'required|unique:' . $this->name . ',name',
            'stock' => 'required',
        ]);

        $this->model->create([
            'name' => $request->name,
            'stock' => $request->stock,
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
        $data = $this->model->find($id);
        $this->authorize('update', $data);

        return view($this->view . "edit", compact('data'));
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
        $data = $this->model->find($id);
        $this->authorize('update', $data);

        $this->validate($request, [
            'name' => 'required|unique:' . $this->name . ',name,' . $id,
            'stock' => 'required',
        ]);

        $data->name = $request->name;
        $data->save();

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
        $model = $this->model->find($id);
        $this->authorize('viewAny', $model);

        DB::table('ingredient_item_detail')->where('ingredient_id', $id)->update(array(
            'ingredient_id' => 1,
        ));

        $model->delete();
        return redirect($this->redirect);

    }
}
