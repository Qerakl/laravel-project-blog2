<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(string $id){
        if($likes = Likes::where("user_id", session("user.id"))->where("post_id", $id)->exists()){
            $posts = Post::where('id', $id)->get();
            foreach ($posts as $post){
                Post::where('id', $post->id)->update([
                    'likes_count' => $post->likes_count-1
                ]);
            }
            Likes::where("user_id", session("user.id"))->where("post_id", $id)->delete();
            return redirect('/');
        }
        Likes::create([
            'user_id' => session("user.id"),
            'post_id' => $id,
        ]);
        $posts = Post::where('id', $id)->get();
        foreach ($posts as $post){
            Post::where('id', $post->id)->update([
                'likes_count' => $post->likes_count+1
            ]);
        }
        return redirect('/');
    }
}
