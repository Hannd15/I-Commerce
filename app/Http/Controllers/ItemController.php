<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class ItemController extends Controller
{
    public function createItem(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'available_amount' => 'required',
        ]);

        // Check if an item with the given name already exists
        if (Item::where('name', $request->name)->exists()) {
            return redirect()->back()->withErrors(['name' => 'This name already exists']);
        }

        // Create the item if it doesn't exist
        Item::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'available_amount' => $request->available_amount,
        ]);

        return redirect()->back()->with('success', 'Item created successfully');
    }
    public function deleteItem(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $item = Item::find($request->id);
        if ($item){
            $item->delete();
            return redirect()->back()->with('success', 'Item deleted successfully');
        }
        return redirect()->back()->with('error', 'Item not found');
    }
    public function updateItem(Request $request){
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'available_amount' => 'required',
        ]);
        $item = Item::find($request->id);
        if ($item){
            $item->name = $request->name;
            $item->description = $request->description;
            $item->price = $request->price;
            $item->available_amount = $request->available_amount;
            $item->save();
            return redirect()->back()->with('success', 'Item updated successfully');
        }
        return redirect()->back()->with('error', 'Item not found');
    }
    public static function getItem($id_item){ // Falta añadir la vista para mostrar el item, sin json xd, se puso por la autocompleción
        $item = Item::find($id_item);
        if ($item){
            return $item;
        }
        return response()->json(['error' => 'Item not found'], 404);
    }
    public function getAllItems(){ // Lo mismo que getItem xd
        $items = Item::all();
        return response()->json($items);
    }
}
