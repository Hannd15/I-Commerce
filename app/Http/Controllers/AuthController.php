<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
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
    public function register(Request $request){
        UserController::createUser($request);

        if(Auth::attempt($request->only(['username', 'password']))){
            return redirect()->route('home');
        }

    }
    public function showRegisterForm(){
        return view('register');
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
