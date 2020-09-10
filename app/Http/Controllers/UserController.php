<?php

namespace App\Http\Controllers;

use App\Model\User;
use DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->model = new User();
        $this->view = 'admin.users.';
        $this->redirect = '/admin/users';
        $this->name = 'users';
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->model);

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

    public function show($id)
    {
        $data = $this->model->find($id);
        $this->authorize('view', $data);
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
            'role' => 'required',
        ]);

        $data->name = $request->name;
        $data->role = $request->role;

        if ($request->password) {
            $data->password = bcript($request->password);
        };
        if ($request->phone) {
            $data->phone = $request->phone;
        };

        $data->save();

        return redirect($this->redirect);
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        $this->authorize('delete', $model);

        $model->delete();
        return redirect($this->redirect);

    }
}
