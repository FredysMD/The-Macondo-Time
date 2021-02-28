<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Auth;


class CommentController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
    */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {  

        $rules = [
            'content'=>"required"
        ];

        $this->validate($request, $rules);

        $user = auth()->user()->id;

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->parent_id = $request->parent_id;
        $comment->user_id = $user;
        $post->comments()->save($comment);

        return redirect()->route('show', $post);
    }
}
