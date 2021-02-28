<div style="padding-top:3%">
    @foreach ($comments as $comment)
        @include('comments.comment', ['comment' => $comment])
    @endforeach
</div>

