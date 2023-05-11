@extends('layouts.master')


@section('title', 'Forgot your password')
    
@section('content')

    <div class="forgot-password-form">

        <div class="mb-4">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <p>
                <input type="email" name="email" placeholder="email" value="{{ old('email') }}" required autofocus/>
            </p>
            @error('email')
                <p class="errors">{{ $message }}</p>
            @enderror

            <button name="submit" class="btn forgot-password-btn">
                Email Password Reset Link
            </button>
            
        </form>

    </div>

@endsection
