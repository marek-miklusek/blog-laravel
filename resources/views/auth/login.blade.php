{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}




@extends('layouts.master')


@section('title', 'Login')

@section('content')

	<form method="POST" action="{{ route('login') }}" class="text-center login-form">
        @csrf

	    <h2 class="text-center">Login</h2>

        {{-- Email --}}
        <p>
            <input class="input " name="email" type="email" placeholder="email" value="{{ old('email') }}">
        </p>
        @error('email')
            <p class="errors">{{ $message }}</p>
        @enderror


        {{-- Password --}}
        <p>
            <input class="input" name="password" type="password" placeholder="password">
        </p>
        @error('password')
            <p class="errors">{{ $message }}</p>
        @enderror

        
        <div>

            {{-- Remember me --}}
            <input type="checkbox" name="remember">
            <span>Remember me</span>
         
            {{-- Submit button --}}
            <button class="btn login-btn">
                Log in
            </button>

        </div>

        {{-- Forgotten password --}}
        @if (Route::has('password.request'))

            <p class="forgot-anchor">
                <a href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            </p>

        @endif

	</form>

@endsection


