<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function new_comment(Request $request){
        $credentials = $request->validate([
            'content' => ['required']
        ]);
        Comment::create([
            'user_id' => session('user.id'),
            'user_name' => session('user.name'),
            'post_id' => $request->id,
            'content' => $request->content
        ]);
        return redirect('/      ');
    }
    public function edit(Request $requset){
        $comments = Comment::where('id', $requset->id)->get();
        return view('updateComment', ['comments' => $comments]);
    }
    public function update(Request $request){
        $credentials = $request->validate([
            'content' => ['required']
        ]);
        Comment::where('id', $request->id)->update([
            'content' => $request->content
        ]);
        return redirect('/');
    }
    public function delete(Request $request){
        Comment::where('id', $request->id)->delete();
        return redirect('/');
    }
}
