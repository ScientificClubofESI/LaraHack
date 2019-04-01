<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('dash') }}/nucleo/css/nucleo.css" rel="stylesheet">
    <!-- Argon CSS -->
    
    @yield('styles')
    <link type="text/css" href="{{ asset('dash') }}/css/dash.css?v=1.0.0" rel="stylesheet">
    <!-- Font Awesome Link --> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
    <!-- Favicon --> 
    <link rel="shortcut icon" href="{{asset('favicon.png')}}">

</head>

<body class="{{ $class ?? '' }}">
    
    @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('layouts.dashboard.navbars.sidebar') 
    @endauth

    <div class="main-content">
        @yield('content')

        {{-- @auth
        <div class="container-fluid">            
            @include('layouts.footers.auth')
        </div>
        @endauth --}}
    </div>
        
    @guest
        @include('layouts.dashboard.footers.guest')
    @endguest
    <script src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

    @stack('js')

</body>

</html>