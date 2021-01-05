@extends('admin.layouts.dashboard')

@section('content')

    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>Roles</h2>
        </div>
        <div class="col-md-6">
            <a href="/roles/create" class="btn btn-primary btn-lg float-md-right" type="button">Create Role</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Roles created
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Permissions</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Permissions</th>
                            <th>Tools</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->slug}}</td>
                            <td>
                                @if ($role->permissions != null)
                                    
                                    @foreach ($role->permissions as $permission)
                                        <span class="badge badge-success">
                                            {{ $permission->name }}                                    
                                        </span>
                                    @endforeach
                            
                                @endif
                            </td>
                            <td>
                                <a href="/role/{{$role->id}}"><i class="fa fa-eye"></i></a>
                                <a href="/roles/{{$role->id}}/edit"><i class="fa fa-edit"></i></a>
                                <a href="#" data-toggle="modal" data-target="#deleteModal" data-roleid = "{{ $role->id }}"><i class="fa fa-trash-alt"></i></a>
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
            <h4 class="modal-title">Delete role</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Select "Delete" if you really want to delete this role.
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                <form method="POST" action="">
                    @method('DELETE')
                    @csrf
                    {{-- <input type="hidden" id="role_id" name="role_id" value=""> --}}
                    <a class="btn btn-danger" onclick="$(this).closest('form').submit();">Delete</a>
                </form>
            </div>
        </div>
        </div>
    </div>
        
@endsection

@section('js_role_page')
    <script>
        
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var role_id = button.data('roleid') 
            
            var modal = $(this)
            // modal.find('.modal-footer #role_id').val(role_id)
            modal.find('form').attr('action','/roles/' + role_id);
         })
    </script>
@endsection