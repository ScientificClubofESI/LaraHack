@extends('layouts.default') 
@section('styles')

<!-- CSS Links -->
<link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<!-- Fonts Links -->
<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet">
<link rel="stylesheet" href="../use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

@endsection
 <!-- Main Page -->
@section('content')

    @include('layouts.navbar')

        @include('sections.landing')
        @include('sections.about')
        @include('sections.challenges')
        @include('sections.prizes')
        @include('sections.faq')
        @include('sections.sponsors')

    @include('layouts.footer')

@endsection

<!-- Scripts Section -->
@section('scripts')

<script src="{{asset('js/jquery-3.2.1.min.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
@endsection