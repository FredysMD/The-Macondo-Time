<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <h6>{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</h6>
        <p class="h6">{{ $comment->content }}</p>

        <a  class="text-decoration-none" data-toggle="collapse" data-target="#reply-{{$comment->id}}" aria-expanded="false" aria-controls="reply-{{$comment->id}}">
            <p class="font-italic">reply</p>   
        </a>
        <div class="collapse my-3" id="reply-{{$comment->id}}">
            @include('comments.create_comment', ['comment' => $comment])
        </div>
        @if ($comment->replies)
            @include('comments.comments', ['comments' => $comment->replies])
        @endif
    </div>
    <hr>
</div>