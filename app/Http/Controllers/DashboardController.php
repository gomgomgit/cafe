<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Item;
use App\Model\User;
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
        $users = User::latest()->take(5)->get();

        return view('admin.dashboard.index', compact('items', 'categories', 'users'));
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
