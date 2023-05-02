<form action="{{ route('comments.store') }}" method="post" class="comment-add-form">
	@csrf

	<div>

		<h4 class="comments-heading">
			New comment:
        </h4>

		<div>
			<textarea rows="3" class="textarea" name="text" placeholder="write your smart comment"></textarea>
		</div>

		@include('partials.errors')

		<button class="btn btn-dark comment-add-btn">
			add comment
		</button>

		@if(session('message_c'))
			<p class="alert alert-success flash-message">{{ session('message_c') }}</p>
		@endif

	</div>

	<input type="hidden" name="post_id" value="{{ $post->id }}">

</form>

