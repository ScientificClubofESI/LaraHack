@extends('emails.layouts.default') 
@section('title') Congrats , Abdelkhalek !
@endsection
 
@section('desc') You have been accepted
to HackIT
@endsection
 
@section('first') You have been accepted to HackIT One last important thing to remember: confirm your
spot by clicking the confirm attendance button .
@endsection
 
@section('second') In case something else has come along and
you won't be able to come, please tell us . <br> We hope to see you at HackIT ! .
@endsection
 
@section('button')
<strong><a href="{{$confirmation_link}}">Confirm Attendance </a></strong>
@endsection