<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
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
        $posts = Post::where('id', $request->id)->get();
        foreach ($posts as $post){
            Post::where('id', $post->id)->update([
                'comments_count' => $post->comments_count+1
            ]);
        }
        return redirect('/');
    }
    public function edit(Request $requset){
        $comments = Comment::where('id', $requset->id)->get();
        foreach ($comments as $comment){
            $users = Comment::where('id', $comment->user_id)->get();
        }
        return view('updateComment', ['comments' => $comments, 'users' => $users]);
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
    $comments = Comment::where('id', $request->id)->get();
    foreach ($comments as $comment){
        $posts = Post::where('id', $comment->post_id)->get();
        foreach ($posts as $post){
            Post::where('id', $post->id)->update([
                'comments_count' => $post->comments_count-1
            ]);
        }
    }

        Comment::where('id', $request->id)->delete();

        return redirect('/');
    }
}
