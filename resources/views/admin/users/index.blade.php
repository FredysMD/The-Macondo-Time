@extends('admin.layouts.dashboard')

@section('content')

<div class="row py-lg-2">
    <div class="col-md-6">
        <h2>Users</h2>
    </div>
    <div class="col-md-6">
        <a href="/users/create" class="btn btn-primary btn-lg float-md-right" type="button">Create user</a>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Users created
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Permission</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Permission</th>
                        <th>Tools</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($users as $user)
                    @if(!\Auth::user()->hasRole('admin') && $user->hasRole('admin')) @continue; @endif
                    <tr {{ Auth::user()->id == $user->id ?  'bgcolor = #20c997' : '' }} >
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td> 
                          @if (count($user->roles))
                                    
                            @foreach ($user->roles as $role)
                                <span class="badge badge-success">
                                    {{ $role->name }}                                    
                                </span>
                            @endforeach
                          
                          @else
                            <span class="badge badge-danger">
                                Not role exist                                     
                            </span>
                          @endif
                        </td>
                        <td> 
                            @if(count($user->permissions))
                                      
                              @foreach ($user->permissions as $permission)
                                <span class="badge badge-success">
                                    {{ $permission->name }}                                    
                                </span>
                              @endforeach
                            
                            @else
                                <span class="badge badge-danger">
                                   Not permissions exist                                    
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="/user/{{$user->id}}"><i class="fa fa-eye"></i></a>
                            <a href="/users/{{$user->id}}/edit"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal" data-userid = "{{ $user->id }}"><i class="fa fa-trash-alt"></i></a>
                        </td>
                    </tr>    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="deleteModal"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
        <h4 class="modal-title">Delete user</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            Select "Delete" if you really want to delete this user.
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
            <form method="POST" action="/users/">
                @method('DELETE')
                @csrf
                <input type="hidden" id="userId" name="userId" value="">
                <a  class="btn btn-danger" onclick="$(this).closest('form').submit();">Delete</a>
            </form>
        </div>
    </div>
    </div>
</div>

    
@endsection
@section('js_post_page')
    <script>
        
        $('#deleteModal').on('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = $(event.relatedTarget)
            // Extract info from data-bs-* attributes
            var recipient = button.data('userid');
          
            var modal = $(this)
            modal.find('.modal-footer #userId').val(recipient);
            modal.find('form').attr('action','/users/' + recipient);
           
        });
    </script>
@endsection