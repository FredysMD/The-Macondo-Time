@extends('admin.layouts.dashboard')

@section('content')
    
    <h1>Edit user</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </u>
        </div>
    @endif

    <form action="/users/{{$user->id}}" method="POST" enctype="multipart/form-data">
        
        @method('PATCH')
        @csrf

        <div class="form-group">
            <label for="title">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name..." value="{{ $user->name }}" required>   
        </div>
        <div class="form-group">
            <label for="title">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ $user->email }}" required>   
        </div>
        <div class="form-group">
            <label for="title">Pasword</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password..." value="{{ $user->password }}" required>   
        </div>
        <div class="form-group">
            <label for="title">Password confirm </label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Repeat password..." value="" required>   
        </div>

        <div class="form-group pt-2">
            <input type="submit" class="btn btn-success btn-lg" value="Update user">
        </div>
    </form>

@endsection