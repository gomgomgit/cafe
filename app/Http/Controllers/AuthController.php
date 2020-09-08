<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');
        $isSuccess = Auth::attempt($credentials);

        if ($isSuccess) {
            return redirect()->intended('/admin/dashboard');
        } else {
            return redirect()->back()->with(['error' => 'Your data false or have not registered']);
        }
    }
    public function register()
    {
        return view('admin.auth.register');
    }
    public function registerProcess(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $encrypted = bcrypt($request->password);

        $request->merge([
            'password' => $encrypted,
            'role' => 'employee',
        ]);

        User::create($request->all());
        return redirect('/admin/login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
