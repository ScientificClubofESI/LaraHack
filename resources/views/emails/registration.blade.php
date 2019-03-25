
@extends('emails.layouts.default') 
@section('title') Registration Done ! 
@endsection
{{--  
@section('desc') You have been accepted
to HackIT
@endsection --}}
 
@section('first') 
@if (!is_null($team_name))
Your team's name is {{$team_name}}
@endif
@endsection
 
@section('second')
@if (!is_null($team_code))
    Your team's code is {{$team_code}}
@endif
@endsection
{{--  
@section('button')
<strong><a href="{{$confirmation_link}}">Confirm Attendance </a></strong>
@endsection --}}