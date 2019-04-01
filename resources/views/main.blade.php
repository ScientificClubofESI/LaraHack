@extends('layouts.main.default') 
@section('styles')

<!-- CSS Links -->
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="../use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

@endsection
 <!-- Main Page -->
@section('content')

    @include('layouts.main.navbar')

        @include('sections.landing')
        @include('sections.about')
        @include('sections.challenges')
        @include('sections.prizes')
        @include('sections.faq')
        @include('sections.sponsors')

    @include('layouts.main.footer')

@endsection

<!-- Scripts Section -->
@section('scripts')

<script src="{{asset('js/script.js')}}"></script>
@endsection