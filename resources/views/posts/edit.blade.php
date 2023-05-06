@extends('layouts.master')


@section('title', 'Edit post')
    
@section('content')
    
    <div class="post-edit-form">
     
        <form action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
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

            <div class="my-2">
                <label for="file">Choose a file to upload:</label>
                <input type="file" name="items[]">
            </div>
            @error('items.0')
                <p class="errors">{{ $message }}</p>
            @enderror

            @include('tags.tags-form', ['type' => 'edit'])

        </form>
        
    </div>

@endsection