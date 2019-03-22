<!DOCTYPE html>
<html lang="en">




<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="HackIT Website">


    <meta property="og:url" content="index.html" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="HackIT" />
    <meta property="og:description" content="{{ config('app.description', 'Laravel') }}" />
    <meta property="og:image" content="images/LOGO.png" />


    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:creator" content="CSE Web Section">
    <meta name="twitter:site" content="index.html">
    <meta name="twitter:title" content="HackIT">
    <meta name="twitter:description" content="Algiers's big student hackathon">
    <meta name="twitter:image:src" content="images/LOGO.png">
    <meta name="twitter:image:width" content="312">
    <meta name="twitter:image:height" content="141"> 
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">

        @yield('styles')

    {{-- <link rel="shortcut icon" href="images/LOGO.png"> --}}

</head>

<body>
    @yield('content') 
    @yield('scripts')
</body>

</html>