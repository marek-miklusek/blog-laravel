{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.master')


@section('title', 'Register')

@section('content')

	<form method="POST" action="{{ route('register') }}" class="text-center login-form">
        @csrf

	    <h2 class="text-center">Register</h2>

        {{-- Name --}}
        <p>
            <input class="input" name="name" placeholder="name" value="{{ old('name') }}">
        </p>
        @error('name')
            <p class="errors">{{ $message }}</p>
        @enderror


        {{-- Email --}}
        <p>
            <input class="input" name="email" type="email" placeholder="email" value="{{ old('email') }}">
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

        
        {{-- Confirm password --}}
        <div>
            <input class="input" name="password_confirmation" type="password" placeholder="again password"/>
        </div>

        {{-- Already registered --}}
        <p class="pt-3">
            <a href="{{ route('login') }}">
                Already registered?
            </a>
        </p>

        {{-- Submit button --}}
        <button class="btn btn-info">
            Register
        </button>

    </form>

@endsection
