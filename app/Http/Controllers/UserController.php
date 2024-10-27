<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public static function createUser(Request $request){

        validator($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ])->validate();

        if(Auth::attempt($request->only(['username', 'password']))){
            return redirect()->back()->withErrors(['username' => 'This username already exists']);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_type' => 2,
        ]);

        return redirect()->back()->with('success', 'User created successfully');
    }
    public function deleteUser(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $user = User::find($request->id);
        if ($user){
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        }
        return redirect()->back()->with('error', 'User not found');
    }
    public function updateUser(Request $request){
        $request->validate([
            'id' => 'required',
            'username' => 'required',
        ]);
        $user = User::find($request->id);
        if ($user){
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success', 'User updated successfully');
        }
        return redirect()->back()->with('error', 'User not found');
    }
    public function getUser(Request $request){ // Falta añadir la vista para mostrar el user, sin json xd, se puso por la autocompleción
        $request->validate([
            'id' => 'required',
        ]);
        $user = User::find($request->id);
        if ($user){
            return response()->json($user);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

}
