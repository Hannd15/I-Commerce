<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        validator($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ])->validate();

        if(Auth::attempt($request->only(['username', 'password']))){
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['username' => 'Wrong username or password']);

    }
    public function showLoginForm()
    {
        return view('login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
