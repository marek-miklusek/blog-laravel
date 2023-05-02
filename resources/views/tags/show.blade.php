<p class="article-tags">

	@foreach ($post->tags as $tag)
		<a href="{{ route('tags.show', urlencode($tag->tag)) }}" class="btn btn-outline-info btn-sm tag-btn">
			<small>{{ $tag->tag  }}</small>
		</a>
	@endforeach

</p>
