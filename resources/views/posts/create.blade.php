@extends('layouts.master')


@section('title', 'Create post')

@section('content')
    
    <div class="post-edit-form">
     
        <form action="/posts" method="POST">
            @csrf

            <h5 class="form-heading">Create post</h5>
            
            <input type="text" name="title" placeholder="title" class="form-control mb-2">
            @error('title')
                <p class="errors">{{ $message }}</p>
            @enderror

            <textarea class="form-control" name="text" rows="12" cols="70" placeholder="text"></textarea>
            @error('text')
                <p class="errors">{{ $message }}</p>
            @enderror
        
            <button type="submit" class="btn btn-primary comment-form-btn">Submit</button>

        </form>
        
    </div>

@endsection