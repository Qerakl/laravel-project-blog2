<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'img',
        'content',
    ];

    public function all_posts(){
        $post = Post::all();
        return $post;
    }
    public function select_post($id){
        $post = Post::where('id', $id)->get();
        return $post;
    }
}
