<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $post;
    public function __construct(){
        $this->post = new Post();
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        foreach ($posts as $post){
            $users = User::where('id', $post->user_id)->get();
        }
        if(empty($users)){
            return view('home', ['posts' => $posts]);
        }
        return view('home', ['posts' => $posts,'users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('newPost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $img = $request->file('img')->store('public');
        $img = $request->img->hashName();
        $content = $request->content;
            Post::create([
                'user_id' => session('user.id'),
                'title' => $title,
                'content' => $content,
                'img' => $img
            ]);
            return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->post->select_post($id);
        $comments = Comment::where('post_id', $id)->get();
        foreach ($comments as $comment){
        }
        if(Comment::where('post_id', $id)->exists()){
            $users = User::where('id', $comment->user_id)->get();
            return view('post', ['posts'=> $post, 'comments' => $comments, 'users' => $users]);
        }
        else{
        $users = 1;
        return view('post', ['posts'=> $post, 'comments' => $comments, 'users' => $users]);
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posts = Post::where('id', $id)->get();
        return view('updatePost', ['posts' => $posts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $title = $request->title;
        $content = $request->content;
        if(empty($request->img)){
            Post::where('id', $id)->update([
                'title' => $title,
                'content' => $content,
            ]);
            return redirect('/');
        }
        $posts = Post::where('id', $id)->get();
        foreach($posts as $post){
            Storage::delete('public/'.$post->img);
        }
        $img = $request->file('img')->store('public');
        $img = $request->img->hashName();
        Post::where('id', $id)->update([
            'title' => $title,
            'content' => $content,
            'img' => $img
        ]);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posts = Post::where('id', $id)->get();
        foreach($posts as $post){
            Storage::delete('public/'.$post->img);
        }
        Post::where('id', $id)->delete();
        return redirect('/');
    }
}
