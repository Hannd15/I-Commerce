<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    public static function createChat(Request $request){

        validator($request->all(), [
            'id_user2' => 'required'
        ])->validate();

        // Check if an item with the given name already exists
        if (Chat::where('name', $request->name)->exists()) {
            return redirect()->back()->withErrors(['name' => 'This chat already exists']);
        }

        $chat = Chat::create([
            'id_user2' => $request->id_user2,
        ]);

        return redirect()->back()->with('success', 'Chat created successfully');
    }
    public function deleteChat(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $chat = Chat::find($request->id);
        if ($chat){
            $chat->delete();
            return redirect()->back()->with('success', 'Chat deleted successfully');
        }
        return redirect()->back()->with('error', 'Chat not found');
    }
    public function getChat(Request $request){ // Falta añadir la vista para mostrar el chat, sin json xd, se puso por la autocompleción
        $request->validate([
            'id' => 'required',
        ]);
        $chat = Chat::find($request->id);
        if ($chat){
            return response()->json($chat);
        }
        return response()->json(['error' => 'Chat not found'], 404);
    }
}
