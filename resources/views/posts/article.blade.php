<article class="post {{ $type }}">

	<h2>
		<a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
	</h2>

	@if ($post->image && $type == 'full')
		<img src="{{ $post->image }}" alt="{{ $post->title }}" class="avatar">
	@endif

	@if ($type == 'full')
		<p>{!! $post->format_text !!}</p>
	@else
		<p>{{ $post->teaser }}</p>
	@endif

	<footer class="d-flex">

		<a href="{{ route('user', $post->user->name) }}" class="author">
			@<strong>{{ $post->user->name }}</strong>
		</a>

		<a href="{{ route('posts.show', $post->slug) }}#comments" class="comments-count">
			{{ $post->comments->count() }} <strong>{{ Str::plural('comment', $post->comments->count()) }}</strong>
		</a>

		<time datetime="{{ $post->datetime }}" class="post-created-at">{{ $post->created_at }}</time>

		@can('update', $post)
			<a href="{{ route('posts.edit', $post->slug) }}" class="post-edit-btn">edit</a>
			<a href="{{ route('posts.delete', $post->slug) }}" class="post-delete-btn">x</a>
		@endcan

	</footer>
	
	@include('partials.files')
	@include('tags.show')

</article>

