@extends('layouts.master')

  
@section('title', 'Post')

@section('content')

    @include('posts.article', ['type' => 'full'])
	@include('comments.index')

@endsection