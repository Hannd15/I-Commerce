<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UserCart;
use App\Http\Controllers\ItemController;

class CartController extends Controller
{
    public function index()
    {
        $id_user = Auth::user()->getAuthIdentifier();

        // Get the user's cart items
        $cart = UserCart::where('id_user', $id_user)->get();

        // Check if the cart has items
        $hasItems = $cart->isNotEmpty();

        if($hasItems){
            foreach($cart as $item){

            }
        }

        return view('cart', ['cart' => $cart, 'hasItems' => $hasItems]);
    }
}
