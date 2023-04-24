@extends('layouts.master')


@section('title', 'Home')
    
@section('content')

    <ol>

        @forelse ($posts as $post)
            <li>
                @include('posts.article', ['type' => 'listing'])
            </li>
        @empty
            <h4>nothing to show :(</h4>
        @endforelse

    </ol>

@endsection