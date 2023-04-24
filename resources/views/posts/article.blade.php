<article class="post {{ $type }}">

	<header>
		<h2>
			<a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
		</h2>
    </header>

	<div>
		<p>{!! nl2br($post->text) !!}</p>
	</div>

	<footer class="d-flex">

		<a href="/users/{{ $post->user->id}}" class="author">
			@<strong>{{ $post->user->name }}</strong>
		</a>

		<a href="/posts/{{ $post->slug }}#comments" class="comments-count">
			{{ $post->comments->count() }} <strong>{{ Str::plural('comment', $post->comments->count()) }}</strong>
		</a>

		@can('update', $post)

			<a href="/posts/{{ $post->slug }}/edit" class="post-edit-btn">edit post</a>

			<form action="/posts/{{ $post->slug }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn comment-delete-btn">x</button>
            </form>
			
		@endcan

	</footer>

</article>
