<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Item;
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
        $items = Item::all();
        $categories = Category::all();

        return view('admin.dashboard.index');
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
