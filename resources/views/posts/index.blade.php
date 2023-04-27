@extends('layouts.master')


@section('title', isset($title) ? $title : 'Home')
    
@section('content')

    <h1 class="user-heading">{{ isset($title) ? $title : '' }}</h1>
    
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