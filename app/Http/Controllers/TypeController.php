<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;


class TypeController extends Controller
{
    public function getType(Request $request){ // Falta añadir la vista para mostrar el type, sin json xd, se puso por la autocompleción
        $request->validate([
            'id' => 'required',
        ]);
        $type = Type::find($request->id);
        if ($type){
            return response()->json($type);
        }
        return response()->json(['error' => 'Type not found'], 404);
    }
}
