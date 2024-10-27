<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id_user' => 'required',
            'id_item' => 'required',
            'rating' => 'required',
        ]);

        // Create the comment if it doesn't exist
        Comment::create([
            'id_user' => $request->user,
            'id_item' => $request->item,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Comment created successfully');
    }
    public function deleteComment(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $comment = Comment::find($request->id);
        if ($comment){
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully');
        }
        return redirect()->back()->with('error', 'Comment not found');
    }
    public function updateComment(Request $request){
        $request->validate([
            'id' => 'required',
            'rating' => 'required',
        ]);
        $comment = Comment::find($request->id);
        if ($comment){
            $comment->id = $request->id;
            $comment->content = $request->content;
            $comment->rating = $request->rating;
            $comment->save();
            return redirect()->back()->with('success', 'Comment updated successfully');
        }
        return redirect()->back()->with('error', 'Comment not found');
    }
    public function getComment(Request $request){ // Falta añadir la vista para mostrar el comment, sin json xd, se puso por la autocompleción
        $request->validate([
            'id' => 'required',
        ]);
        $comment = Comment::find($request->id);
        if ($comment){
            return response()->json($comment);
        }
        return response()->json(['error' => 'Comment not found'], 404);
    }
}
