<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    public function getStatus(Request $request){ // Falta añadir la vista para mostrar el status, sin json xd, se puso por la autocompleción
        $request->validate([
            'id' => 'required',
        ]);
        $status = Status::find($request->id);
        if ($status){
            return response()->json($status);
        }
        return response()->json(['error' => 'Status not found'], 404);
    }
}
