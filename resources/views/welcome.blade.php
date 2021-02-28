@extends('layouts.app')

@section('content')

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Macondo</h1>
            <span class="subheading">"La vida no es la que uno vivió, sino la que recuerda y cómo la recuerda para contarla"</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
        @if(count($posts))
          @foreach ($posts as $post)
            <div class="col-md-4">
              <img class="img-thumbnail mt-4" src="{{ asset('/storage/images/posts_images/'.$post->image_url) }}" alt="{{ $post->image_url}}" width="100%">
            </div>
            <div class="col-lg-8 col-md-10 mx-auto">
              <div class="post-preview">
                <a href="/home/{{ $post->id }}">
                  <h2 class="post-title">
                    {{ $post->title }}
                  </h2>
                  <h3 class="post-subtitle">
                    {!! getShorterString($post->content,30) !!}
                  </h3>
                </a>
                <p class="post-meta">Posted by
                  @if(isset($post->user['name']))
                    <a href="/home/{{ $post->id }}">{{ $post->user['name'] }}</a>
                    on {{ $post->created_at->diffForHumans() }}</p> 
                  @else
                    <a href="/home/{{ $post->id }}">The Macondo Time</a>
                    on {{ $post->created_at->diffForHumans() }}</p>
                  @endif
              </div>  
            </div> 
            <hr>
          @endforeach
        @else
          <div class="col-lg-8 col-md-10 mx-auto alert alert-warning text-justify" role="alert">
           Not exists post in The Macondo Time. <a href="/posts/create" class="alert-link">Create post</a>.
          </div>
        @endif

    </div>
    {{ $posts->links() }}  
  </div>
  <hr>

@endsection