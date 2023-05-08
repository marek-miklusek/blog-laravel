@extends('layouts.master')


@section('title', 'Create post')

@section('content')
    
    <div class="post-edit-form">
     
        <form id="add-form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h5 class="form-heading">Create post</h5>
            
            <input type="text" name="title" value="{{ old('title') }}" class="form-control mb-2" placeholder="title" autofocus>
            @error('title')
                <p class="errors">{{ $message }}</p>
            @enderror

            <textarea name="text" rows="12" cols="70" class="form-control" placeholder="text">{{ old('text') }}</textarea>
            @error('text')
                <p class="errors">{{ $message }}</p>
            @enderror

            @include('partials.upload-files')
            @include('tags.tags-form', ['type' => 'create'])

        </form>
        
    </div>

@endsection