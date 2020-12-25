@extends('admin.layouts.dashboard')

@section('content')
    
    <h1>Edit post</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </u>
        </div>
    @endif

    <form action="/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
        
        @method('PATCH')
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Title..." value="{{ $post->title }}" required>   
        </div>

        <div class="form-group">
            <label for="image">Select image</label>
            <input type="file" name="image" class="form-control-file" id="image" required>
        </div>
        <div class="row">
            <img src="{{ asset('/storage/images/posts_images/'.$post->image_url) }}" class="img-thumbnail mx-auto" alt="{{ $post->image_url}}" width="250">
        </div>

        <div class="form-group">
            <label for="content">Insert content</label>
            <textarea name="post_content" id="content" required>{{ $post->content }}</textarea>
        </div>

        <div class="form-group pt-2">
            <input type="submit" class="btn btn-success btn-lg" value="Update post">
        </div>
    </form>

    <script>
        CKEDITOR.replace('content');
    </script>

@endsection