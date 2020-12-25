@extends('admin.layouts.dashboard')

@section('content')
    
    <h1>Create new post</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </u>
        </div>
    @endif

    <form action="/posts" method="POST" enctype="multipart/form-data">
        
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Title..." value="{{ old('title') }}" required>   
        </div>

        <div class="form-group">
            <label for="image">Select image</label>
            <input type="file" name="image" class="form-control-file" id="image" required>
        </div>

        <div class="form-group">
            <label for="content">Insert content</label>
            <textarea name="post_content" id="content" required>{{ old('post_content') }}</textarea>
        </div>

        <div class="form-group pt-2">
            <input type="submit" class="btn btn-success btn-lg" value="Create post">
        </div>
    </form>

    <script>
        CKEDITOR.replace('content');
    </script>

@endsection