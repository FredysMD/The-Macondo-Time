@extends('admin.layouts.dashboard')

@section('content')
    
    <h1>Create new role</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </u>
        </div>
    @endif

    <form action="/roles" method="POST" enctype="multipart/form-data">
        
        @csrf

        <div class="form-group">
            <label for="title">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name..." value="{{  old('name') }}" required>   
        </div>
        <div class="form-group">
            <label for="title">Slug</label>
            <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug..." value="{{  old('slug') }}" required>   
        </div>
        <div class="form-group">
            <label for="title">Permissions</label>
            <input type="text" name="roles_permission" class="form-control" id="roles_permission" placeholder="Roles..." value="{{  old('roles_permission') }}" required>   
        </div>
        <div class="form-group pt-2">
            <input type="submit" class="btn btn-success btn-lg" value="Create role">
        </div>
    </form>

@endsection