@extends('layouts.master')


@section('title', 'Register')

@section('content')

	<form method="POST" action="{{ route('register') }}" class="text-center login-form">
        @csrf

	    <h2 class="text-center">Register</h2>

        <p>
            <input class="input" name="name" placeholder="name" value="{{ old('name') }}">
        </p>
        @error('name')
            <p class="errors">{{ $message }}</p>
        @enderror


        <p>
            <input class="input" name="email" type="email" placeholder="email" value="{{ old('email') }}">
        </p>
        @error('email')
            <p class="errors">{{ $message }}</p>
        @enderror


        <p>
            <input class="input" name="password" type="password" placeholder="password">
        </p>
        @error('password')
            <p class="errors">{{ $message }}</p>
        @enderror

        
        <div>
            <input class="input" name="password_confirmation" type="password" placeholder="password again"/>
        </div>

        <p class="pt-3">
            <a href="{{ route('login') }}">
                Already registered?
            </a>
        </p>

        <button class="btn btn-info">
            Register
        </button>

    </form>

@endsection
