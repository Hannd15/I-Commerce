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
        $items = array();

        if($hasItems){
            foreach($cart as $item){
                $id_item = $item->id_item;
                $amount = $item->amount;
                $item = ItemController::getItem($id_item);
                //embeds the amount returned from the database in the item
                $item->amount = $amount;
                array_push($items, $item);
            }
        }

        return view('cart', ['items' => $items, 'hasItems' => $hasItems]);
    }
    public function updateCart(Request $request){
        $request->validate([
            'id_user' => 'required',
        ]);
        foreach($request->all() as $key => $value){
            if (gettype($key)!= 'string'){
                $item = UserCart::find($key);
                $item->amount = $value;
                $item->save();
            }
        }

        return redirect()->back()->with('success', 'Item updated successfully');
    }
}
