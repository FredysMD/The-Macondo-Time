<div class="container">
  <div class="row p-2">
    <div class="col-lg-12 col-md-10 mx-auto">
		<p class="h4">{{Auth::user()->name}}</p>

		<form action="{{route('comments.store', $post)}}" method="POST">
			{{ csrf_field() }}
			
			@if(isset($comment->id))
				<input type="hidden" name="parent_id" value="{{$comment->id}}">
			@endif
			
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			
			<div class="form-group">
				<label for="content"></label>
				<textarea placeholder="Write a comment..." class="form-control" name="content" id="content" required></textarea>
			</div>
			<button  type="submit" class="btn btn-outline-dark btn-sm">Comment</button>
		</form>
	</div>
   </div>
</div>
