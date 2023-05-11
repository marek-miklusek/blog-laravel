@extends('layouts.master')


@section('title', 'Edit post')
    
@section('content')
    
    <div class="post-edit-form">
     
        <form id="edit-form" action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
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

            @if($post->files)
                <ul class="mb-0">
                    @foreach($post->files as $file)
                        <li class="edit-files">
                            <img src="{{ $file->imgFile($file) }}" alt="" class="img-file">
                            {{ $file->name }}
                            <a href="{{ url('delete', $file->id) }}" class="delete-file float-end">x</a>
                        </li>
                    @endforeach
                </ul>
            @endif

            @include('partials.add-image')
            @include('partials.upload-files')

            <button class="btn btn-success">Submit</button>

            <span class="or">
                or <a href="{{ route('posts.show', $post->slug) }}">cancel</a>
            </span>
            
            @include('tags.tags-form', ['type' => 'edit'])

        </form>
        
    </div>

@endsection