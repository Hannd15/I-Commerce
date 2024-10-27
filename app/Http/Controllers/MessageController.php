<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public static function createMessage(Request $request){

        validator($request->all(), [
            'id_chat' => 'required',
            'id_user' => 'required',
            'content' => 'required',
        ])->validate();

        $message = Message::create([
            'id_user' => $request->id_user,
            'id_chat' => $request->id_chat,
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', 'Message created successfully');
    }
    public function getMessages(Request $request){ // Falta añadir la vista para mostrar el message, sin json xd, se puso por la autocompleción
        $request->validate([
            'id_user' => 'required',
            'id_chat' => 'required',
        ]);
        $messages = Message::where('id_user', $request->id_user)->where('id_chat', $request->id_chat)->get();
        if ($messages){
            return response()->json($messages);
        }
        return response()->json(['error' => 'No messages found'], 404);
    }
}
