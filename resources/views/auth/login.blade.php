@extends('layouts.master')


@section('title', 'Login')

@section('content')

	<form method="POST" action="{{ route('login') }}" class="text-center login-form">
        @csrf

	    <h2 class="text-center">Login</h2>

        <p>
            <input class="input " name="email" type="email" placeholder="email" value="{{ old('email') }}">
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
            <input type="checkbox" name="remember">
            <span>Remember me</span>
            <button class="btn login-btn">
                Log in
            </button>
        </div>

        <p class="pt-3 mb-0">
            by <a href="/auth/github">Github</a>
            by <a href="/auth/facebook">Facebook</a>
        </p>

        @if (Route::has('password.request'))
            <p class="forgot-password">
                <a href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            </p>
        @endif

	</form>

@endsection


