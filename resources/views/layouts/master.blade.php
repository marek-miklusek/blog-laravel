<!DOCTYPE html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Laravel')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body class="{{ Request::segment(1) ?: 'home' }}">

        @include('partials.navigation')

        @if(session('message'))
            <p class="alert alert-success flash-message">{{ session('message') }}</p>
        @endif

        <header>
            <h1 class="main-heading">
                <a href="/" class="main-logo">(｡◕‿◕｡)</a>
            </h1>
        </header>

        <main class="container main-box">
            @yield('content')
        </main>

    </body>
</html>

