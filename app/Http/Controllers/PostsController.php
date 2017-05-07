<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    //
    public function index()
    {
        $posts = Post::latest()->get();
//        $posts = Post::orderBy('created_at', 'dsc')->get();
        return view('posts/index',compact('posts'));
    }
    public function show(Post $post)
    {

        return view('posts/show',compact('post'));
    }
    public function create()
    {
        return view('posts/create');
    }
    public function store()
    {
//        dd(\request()->all());

        $this->validate(\request(),[
            'title' => 'required|max:30',
            'body' => 'required'
        ]);
        Post::create(request(['title','body']));

//        Post::create([
//            'title' => request('title'),
//            'body' => request('body')
//        ]);
//        $post = new Post;
//        $post->title = \request('title');
//        $post->body = \request('body');
//        $post->save();
//
        return redirect('/');

        //create new post using request data
        //store it to the dB
        //redirect to homepage
    }

}