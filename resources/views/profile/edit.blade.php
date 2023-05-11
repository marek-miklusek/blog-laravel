@extends('layouts.master')


@section('title', 'Profile')
    
@section('content')

    <div class="row">
        
        <div class="col-md-6">

            @if($user->avatar)
                <img src="{{ $user->avatar['thumb'] }}" alt="{{ $user->name }}" class="avatar">
            @else
                <p class="add-avatar">Add your image</p>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="d-flex justify-content-between">
                    <input type="file" name="avatar">
                    <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                </div>
            </form>

            @error('avatar')
                <p class="errors">{{ $message }}</p>
            @enderror

            <a href="{{ route('profile.delete', $user->id) }}">delete image</a>
            
        </div>

        <div class="profile-box col-md-6">
            <section>
                @include('profile.partials.update-profile-information-form')
            </section>

            <section class="pt-3">
                @include('profile.partials.update-password-form')
            </section>
            
            <section class="pt-3">
                @include('profile.partials.delete-user-form')
            </section>
        </div>

    </div>

@endsection
 