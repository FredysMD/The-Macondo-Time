@extends('layouts.app')

@section('content')
    
<header class="masthead" style="background-image: url('{{ asset('/storage/images/posts_images/'.$post['image_url']) }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading">
            <h1>{{$post->title}}</h1>
            @if(isset($post->user->name))
                <span class="subheading">By {{ $post->user->name }}</span>
            @else
            <span class="subheading">By The Macondo Time</span>
            @endif
            
            </div>
        </div>
        </div>
    </div>
    </header>

    <!-- Main Content -->
    <div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        <p>{!!$post->content!!}</p>
        </div>
    </div>
    </div>
    <hr>

@endsection