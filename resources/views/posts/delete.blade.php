@extends('layouts.master')


@section('title', 'Delete post')
    
@section('content')

    <h1 class="text-center form-heading">Are you sure you want to do this?</h1>

    <article class="post">

        <h2>
            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
        </h2>

        <p>{{ $post->teaser }}</p>

        <footer class="d-flex">

            <a href="{{ route('user', $post->user->name) }}" class="author">
                @<strong>{{ $post->user->decoded_name }}</strong>
            </a>

            <a href="{{ route('posts.show', $post->slug) }}#comments" class="comments-count">
                {{ $post->comments->count() }} <strong>{{ Str::plural('comment', $post->comments->count()) }}</strong>
            </a>

            <time datetime="{{ $post->datetime }}" class="post-created-at">{{ $post->created_at }}</time>

            @can('update', $post)

                <form action="{{ route('posts.destroy', $post->slug) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger delete-post">Delete post</button>
                </form>
                
            @endcan

            <span class="or">
                or <a href="{{ url()->previous() }}" class="mx-1">cancel</a>
            </span>

        </footer>

        @include('tags.show')

    </article>

@endsection