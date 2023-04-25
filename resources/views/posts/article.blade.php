<article class="post {{ $type }}">

	<header>
		<h2>
			<a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
		</h2>
    </header>

	@if ($type == 'full')
		<p>{!! $post->format_text !!}</p>
	@else
		<p>{{ $post->teaser }}</p>
	@endif

	<footer class="d-flex">

		<a href="/users/{{ $post->user->id }}" class="author">
			@<strong>{{ $post->user->name }}</strong>
		</a>

		<a href="/posts/{{ $post->slug }}#comments" class="comments-count">
			{{ $post->comments->count() }} <strong>{{ Str::plural('comment', $post->comments->count()) }}</strong>
		</a>

		<p class="post-created-at">{{ $post->created_at }}</p>

		@can('update', $post)

			<a href="/posts/{{ $post->slug }}/edit" class="post-edit-btn">edit</a>

			<form action="/posts/{{ $post->slug }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn comment-delete-btn">x</button>
            </form>
			
		@endcan

	</footer>

</article>

