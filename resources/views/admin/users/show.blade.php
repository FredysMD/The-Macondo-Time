@extends('admin.layouts.dashboard')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Name: {{ $user->name}}</h3>
            <h4>Email: {{ $user->email }}</h4>
            <h4>Number of Posts: dsd</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title">Role</h5>
            <p class="card-text">
                ---
            </p>
            <h5 class="card-title">Permission</h5>
            <p class="card-text">
                ----
            </p>
        </div>        
        <div class="card-footer">
            <a href="/users" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</div>

@endsection