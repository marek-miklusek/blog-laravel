<section id="comments" class="comments-box">

	@auth
		@include('comments.create')
	@endauth

	<h4 class="comments-heading">Comments:</h4>

	<ol class="comment-list">
		@forelse ($post->comments as $comment)
			<li>
				@include('comments.show')
			</li>
		@empty
			<p class="no-comments">No comments so far, be first :)</p>
		@endforelse 
	</ol>

</section>