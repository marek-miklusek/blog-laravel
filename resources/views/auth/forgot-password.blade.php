@extends('layouts.master')


@section('title', 'Forgot your password')
    
@section('content')

    <div class="forgot-password-form">

        <x-guest-layout>
            <div class="mb-4">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-text-input id="email" class="px-2 py-1" type="email" name="email" placeholder="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 errors" />
                </div>

                    {{-- <x-primary-button> --}}
                <button name="submit" class="btn forgot-password-btn">
                    Email Password Reset Link
                </button>
                    {{-- </x-primary-button> --}}
           
            </form>
        </x-guest-layout>

    </div>

@endsection
