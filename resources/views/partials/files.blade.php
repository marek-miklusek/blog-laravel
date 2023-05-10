@if ($post->post_files)
    <p class="my-2">
		@foreach ($post->post_files as $file)
			<a href="{{ url('download', [$file->id, $file->name]) }}" class="btn btn-outline-success btn-sm">
				<img src="{{ $file->imgFile($file) }}" alt="" class="img-file">{{ $file->name }}
			</a>
		@endforeach
	</p>
@endif