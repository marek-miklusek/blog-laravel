@extends('layouts.master')


@section('title', 'Edit comment')

@section('content')
    
    <div class="comment-edit-form">

        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <h5 class="form-heading">Edit comment</h5>
            <textarea class="form-control" name="text" rows="3" cols="60">{{ $comment->text }}</textarea>

            @include('partials.errors')
        
            <button type="submit" class="btn btn-primary comment-form-btn">Submit</button>
            <span class="or">
                or <a href="{{ route('posts.show', $comment->post->slug) }}">cancel</a>
            </span>

        </form>
        
    </div>
  
@endsection