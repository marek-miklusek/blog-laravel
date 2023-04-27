@extends('layouts.master')


@section('title', 'Edit post')
    
@section('content')
    
    <div class="post-edit-form">
     
        <form action="{{ route('posts.update', $post->slug) }}" method="POST">
            @csrf
            @method('PATCH')

            <h5 class="form-heading">Edit post</h5>
            
            <input type="text" name="title" value="{{ $post->title }}" placeholder="title" class="form-control mb-2">
            @error('title')
                <p class="errors">{{ $message }}</p>
            @enderror

            <textarea class="form-control" name="text" rows="12" cols="70" placeholder="text">{{ $post->text }}</textarea>
            @error('text')
                <p class="errors">{{ $message }}</p>
            @enderror
        
            <button type="submit" class="btn btn-primary comment-form-btn">Submit</button>

        </form>
        
    </div>

@endsection