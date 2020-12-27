@extends('admin.layouts.dashboard')

@section('content')

    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>Posts</h2>
        </div>
        <div class="col-md-6">
            <a href="/posts/create" class="btn btn-primary btn-lg float-md-right" type="button">Create Post</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Posts created
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th>Creator</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th>Creator</th>
                            <th>Tools</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{!! getShorterString($post->content,20) !!}</td>
                            <td><img src="{{ asset('/storage/images/posts_images/'.$post->image_url) }}" alt="{{ $post->image_url}}" width="100"></td>
                            <td>{{$post->user['name']}}</td>
                            <td>
                                <a href="/posts/{{$post->id}}/edit"><i class="fa fa-edit"></i></a>
                                <a href="#" data-toggle="modal" data-target="#deleteModal" data-postid = "{{ $post->id }}"><i class="fa fa-trash-alt"></i></a>
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
            <h4 class="modal-title">Delete post</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                Select "Delete" if you really want to delete this post.
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                <form method="POST" action="/posts/">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" id="postId" name="postId" value="">
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
            var recipient = button.data('postid');
          
            var modal = $(this)
            modal.find('.modal-footer #postId').val(recipient);
            modal.find('form').attr('action','/posts/' + recipient);
           
        });
    </script>
@endsection