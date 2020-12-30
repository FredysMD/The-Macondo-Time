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

    <form action="/roles/{{ $role->id }}" method="POST" enctype="multipart/form-data">
        
        @method('PATCH')
        @csrf


        <div class="form-group">
            <label for="title">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name..." value="{{  $role->name }}" required>   
        </div>
        <div class="form-group">
            <label for="title">Slug</label>
            <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug..." value="{{  $role->slug }}" required>   
        </div>
        <div class="form-group">
            <label for="title">Permissions</label>
            <input type="text" data-role="tagsinput" name="roles_permission" class="form-control" id="roles_permission" placeholder="Roles..." value="@foreach ($role->permissions as $permission)
            {{$permission->name. ","}}
        @endforeach" required>   
        </div>
        <div class="form-group pt-2">
            <input type="submit" class="btn btn-success btn-lg" value="Update role">
        </div>
    </form>
    @section('css_role_page')
    <link rel="stylesheet" href="/css/bootstrap-tagsinput.css">
@endsection

@section('js_role_page')
    <script src="/js/admin/bootstrap-tagsinput.js"></script>
    <script>
        $(document).ready(function(){
            $('#name').keyup(function(e){
                var str = $('#name').val();
                str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//rplace stapces with dash
                $('#slug').val(str);
                $('#slug').attr('placeholder', str);
            });
        });
        
    </script>
@endsection
@endsection

