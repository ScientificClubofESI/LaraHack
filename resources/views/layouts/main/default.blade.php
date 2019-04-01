<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta Tags For SEO -->
    <meta name="description" content="{{ config('app.description') }}">

    <meta property="og:url" content=" {{route('home')}} " />
    <meta property="og:type" content="article" />
    <meta property="og:title" content=" {{config('app.name')}} " />
    <meta property="og:description" content="{{ config('app.description') }}" />
    <meta property="og:image" content=" {{asset('images/LOGO.png')}} " />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{route('home')}} ">
    <meta name="twitter:title" content="{{config('app.name')}}  ">
    <meta name="twitter:description" content="{{ config('app.description') }}">
    <meta name="twitter:image:src" content="{{asset('images/LOGO.png')}} ">
    <meta name="twitter:image:width" content="312">
    <meta name="twitter:image:height" content="141">

    <title>{{ config('app.name') }}</title>
    <!-- Favicon --> 
    <link rel="shortcut icon" href="{{asset('favicon.png')}}">
    <!-- Karla Font --> 
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet"> 
    <!-- Bootstrap Minify -->
    <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">

    @yield('styles')

</head>

<body>
    @yield('content')


    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap/bootstrap.min.js')}}"></script>
    @yield('scripts')
</body>

</html>