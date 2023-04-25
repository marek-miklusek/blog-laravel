@extends('layouts.master')


@section('title', 'Profile')
    
@section('content')

    <div class="profile-box">
        <section>
            @include('profile.partials.update-profile-information-form')
        </section>

        <section class="pt-4">
            @include('profile.partials.update-password-form')
        </section>

        <section class="pt-4">
            @include('profile.partials.delete-user-form')
        </section>
    </div>

@endsection
 