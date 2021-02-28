@extends('layouts.app')

@section('content')

@if($post)
    <header class="masthead" style="background-image: url('{{ asset('/storage/images/posts_images/'.$post['image_url']) }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                <h1>{{$post->title}}</h1>
                @if(isset($post->user->name))
                    <span class="subheading">By {{ $post->user->name }}</span>
                @else
                    <span class="subheading">By The Macondo Times</span>
                @endif
                </div>
            </div>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <p class="h6 text-center">Shares by</p>
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="http://www.facebook.com/sharer.php?href=<http://themacondotimes.herokuapp.com/home/{{$post->id}}>&t=<{{$post->title}}>">
                            <span class="fa-stack fa-sm">
                                <i class="fab fa-facebook-f"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://twitter.com/intent/tweet?text={{$post->title}}&url=http://themacondotimes.herokuapp.com/home/{{$post->id}}">
                            <span class="fa-stack fa-sm">
                                <i class="fab fa-twitter"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://api.whatsapp.com/send?text=http://themacondotimes.herokuapp.com/home/{{$post->id}}">
                            <span class="fa-stack fa-sm">
                                <i class="fab fa-whatsapp"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
            <p>{!!$post->content!!}</p>
            </div>
        </div> 
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <a type="button"  data-toggle="modal" data-target="#myModal"><i class="far fa-comments"></i></a>
                <small>{{count($post->comment($post->id))}}</small> 
            </div>
        </div>
        <hr>
    </div>
        <!-- Modal -->
    <div class="modal right fade" tabindex="-1" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center">Comments({{count($post->comment($post->id))}})</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @include('comments.create_comment')
                    <hr>
                    @include('comments.comments', ['comments' => $post->comments])
                </div>
                <div class="modal-footer left">
                    <button type="button" class="close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@else
    <header class="masthead" style="background-image: url('/img/notpost.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>No exits</h1>
                    <span class="subheading">By The Macondo Times</span>
                </div>
            </div>
            </div>
        </div>>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <p> Not exists post. <a href="/" class="alert-link">Go to Home</a>.</p>
            </div>
        </div>
    </div>
    <hr>
@endif

@endsection