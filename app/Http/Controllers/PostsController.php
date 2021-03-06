<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Repositories\Posts;
use Carbon\Carbon;

class PostsController extends Controller
{
    //

    public function __construct()
        //constructor injection means passing arguments into a new object constructor
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Posts $posts)
        //dependency injection means passing arguments to a function
    {
        $posts = $posts->all();
//        $posts = (new \App\Repositories\Posts)->all();

//        $posts = Post::latest()->
//        filter(request(['month', 'year']))->
//        get();


//        $posts = Post::orderBy('created_at', 'dsc')->get();
        return view('posts/index', compact('posts'));
    }

    public function show(Post $post)
    {

        return view('posts/show', compact('post'));
    }

    public function create()
    {
        return view('posts/create');
    }

    public function store()
    {
//        dd(\request()->all());

        $this->validate(request(), [
            'title' => 'required|max:30',
            'body' => 'required'
        ]);

        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );

        session()->flash(
            'message','Your Post is now published.'
        );

//        Post::create([
//            'title' => request('title'),
//            'body' => request('body'),
//            'user_id' => auth()->id()
//        ]);

//        auth()->user()->id same as auth()->id()

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
