<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Auth;


class PostsController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.posts.create');  
    }

    /** 
     * Return name image and location en storage.
     * 
     * @param $image -> location of images in PC.
     * @return $newFileName
     * 
    */
    public function upload($image)
    {
        $fileNameWithExtension = request($image)->getClientOriginalName();

        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

        $extension = request($image)->getClientOriginalExtension();

        $newFileName = $fileName.'_'.time().'.'.$extension;

        $path = request($image)->storeAs('public/images/posts_images/', $newFileName);

        return $newFileName;

    }

    /**
     * validator: validate the fields in form.
     *
     * @param  $options -> options for validate.
     * @return ->  nothing.
    */
    public function validator($options)
    {
        $data = request()->validate($options);
        
    }

    public function deleteImage($imagePost)
    {
        $image = public_path().'/storage/images/posts_images/'.$imagePost;

        if(file_exists($image)){
            unlink($image);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //
        $options = ['image'=>'required|image'];

        $this->validator($options);

        $user = auth()->user();
        
        $image = $this->upload('image');

        $newPost = new Post();

        $newPost->title = request('title');
        $newPost->content = request('post_content');
        $newPost->image_url = $image;
        $newPost->userId =  $user->id;

        $newPost->save();

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $post = Post::find($post->id);

        return view('admin.posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $options = ['image'=>'required|image'];

        $this->validator($options);

        $user = auth()->user();
        
        $image = $this->upload('image');

        $updatePost = Post::findOrFail($post->id);

        $updatePost->title = request('title');
        $updatePost->content = request('post_content');
        $updatePost->image_url = $image;
        $updatePost->userId =  $user->id;

        $updatePost->save();

        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        
        $post = Post::find($request->postId);

        $image = $post->image_url;
        $this->deleteImage($image);
        $post->delete();

        return redirect('posts');
    }
}
