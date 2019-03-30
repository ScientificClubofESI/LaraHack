
@extends('emails.layouts.default') 
@section('title') Hi {{$hacker->first_name }} , Your registration is done !
@endsection

 
@section('first') 
@if (!is_null($team_name))
Your team's name is {{$team_name}}
@endif
@endsection
 
@section('second')
@if (!is_null($team_code))
    Your team's code is {{$team_code}} . Please share that code only with your teammates .
@endif
@endsection
