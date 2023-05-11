@extends('layouts.master')


@section('title', 'Create tag')
    
@section('content')

    <h4 class="text-center form-heading">Create new tag</h4>

    <form class="form-group d-flex justify-content-center gap-2 py-2" action="{{ route('tags.store') }}" method="POST">
        @csrf
        <input type="text" name="tag" placeholder="enter new tag" autofocus>
        <button class="btn btn-primary">Submit</button>
    </form>

    <div class="d-flex justify-content-center">
        @error('tag')
            <p class="errors">{{ $message }}</p>
        @enderror
    </div>

    <p class="text-center">
        <a href="{{ url()->previous() }}">back</a>
    </p>

    <h5 class="container">or delete tag:</h5>

    <div class="container d-flex flex-wrap gap-2">
        @foreach ($tags as $tag)
            <form action="{{ route('tags.destroy', $tag->tag) }}" method="Post">
                @csrf
                @method('DELETE')
                <button class="btn btn-dark">{{ $tag->tag }}<span class="tags-delete-btn">&times;</span></button>
            </form>
        @endforeach 
    </div>

@endsection