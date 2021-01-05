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

        <div class="form-group">
            <label for="role">Select Role</label>
    
            <select class="role form-control" name="role" id="role">
                <option value="">Select Role...</option>
                @foreach ($roles as $role)
                <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}" {{ $user->roles->isEmpty() || $role->name != $userRole->name ? "" : "selected"}}>{{$role->name}}</option>
                @endforeach
            </select>
        </div>
        
        <div id="permissions_box" >
            <label for="roles">Select Permissions</label>
            <div id="permissions_ckeckbox_list"></div>
        </div>

        @if($user->permissions->isNotEmpty())
            @if($rolePermissions != null)
                <div id="user_permissions_box" >
                    <label for="roles">User Permissions</label>
                    <div id="user_permissions_ckeckbox_list">                    
                        @foreach ($rolePermissions as $permission)
                        <div class="custom-control custom-checkbox">                         
                            <input class="custom-control-input" type="checkbox" name="permissions[]" id="{{$permission->slug}}" value="{{$permission->id}}" {{ in_array($permission->id, $userPermissions->pluck('id')->toArray() ) ? 'checked="checked"' : '' }}>
                            <label class="custom-control-label" for="{{$permission->slug}}">{{$permission->name}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    
        <div class="form-group pt-2">
            <input class="btn btn-success" type="submit" value="Update user">
        </div>
    </form>    
    
    @section('js_user_page')

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <script>
            $(document).ready(function(){

                var permissions_box = $('#permissions_box');
                var permissions_ckeckbox_list = $('#permissions_ckeckbox_list');
                var user_permissions_box = $('#user_permissions_box');
                var user_permissions_ckeckbox_list = $('user_permissions_ckeckbox_list');

                permissions_box.hide(); // hide all boxes

                $('#role').on('change', function() {

                    var role = $(this).find(':selected');    
                    var role_id = role.data('role-id');
                    var role_slug = role.data('role-slug');


                    permissions_ckeckbox_list.empty();
                    user_permissions_box.empty();

                    $.ajax({
                        url: "/users/create",
                        method: 'get',
                        dataType: 'json',
                        data: {
                            role_id: role_id,
                            role_slug: role_slug,
                        }
                    }).done(function(data) {
                        
                        
                        permissions_box.show();                        
                        // permissions_ckeckbox_list.empty();
                        $.each(data, function(index, element){
                            $(permissions_ckeckbox_list).append(       
                                '<div class="custom-control custom-checkbox">'+                         
                                    '<input class="custom-control-input" type="checkbox" name="permissions[]" id="'+ element.slug +'" value="'+ element.id +'">' +
                                    '<label class="custom-control-label" for="'+ element.slug +'">'+ element.name +'</label>'+
                                '</div>'
                            );
                        });
                    });
                });
            });
        </script>
    
    @endsection
    
    
    @endsection