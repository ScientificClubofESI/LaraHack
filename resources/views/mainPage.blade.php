@extends('layouts.default') 
@section('styles')
<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet">
<link rel="stylesheet" href="../use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
@endsection
 
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


@section('scripts')

<script src="../code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/script.js"></script>
@endsection