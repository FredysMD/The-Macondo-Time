<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $numPost = 3;
        $isPublished = 1;

        $posts = Post::where('published', $isPublished)->orderBy('created_at','desc')->simplePaginate($numPost);
        
        return view('welcome',['posts' => $posts]);
    }

    public function show($id)
    {
        $postid = Post::find($id);

        return view('show', ['post' => $postid]);
    }
}
