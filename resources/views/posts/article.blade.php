<article class="post {{ $type }}">

	<header>
		<h2>
			<a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
		</h2>
    </header>

	@if ($type == 'full')
		<p>{!! $post->format_text !!}</p>
	@else
		<p>{{ $post->teaser }}</p>
	@endif

	<footer class="d-flex">

		<a href="{{ route('user', $post->user->id) }}" class="author">
			@<strong>{{ $post->user->name }}</strong>
		</a>

		<a href="{{ route('posts.show', $post->slug) }}#comments" class="comments-count">
			{{ $post->comments->count() }} <strong>{{ Str::plural('comment', $post->comments->count()) }}</strong>
		</a>

		<time datetime="{{ $post->datetime }}" class="post-created-at">{{ $post->created_at }}</time>

		@can('update', $post)

			<a href="{{ route('posts.edit', $post->slug) }}" class="post-edit-btn">edit</a>

			<form action="{{ route('posts.destroy', $post->slug) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn comment-delete-btn">x</button>
            </form>
			
		@endcan

	</footer>

</article>

