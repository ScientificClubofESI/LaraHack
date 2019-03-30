@extends('emails.layouts.default') 
@section('title') Sorry , {{$hacker->first_name}} !
@endsection
 
@section('desc') You haven't been accepted
to {{config('app.name')}}
@endsection
 
@section('first') Thank you for applying to {{config('app.name')}}. 
Unfortunately, we are unable to offer you an invitation to {{config('app.name')}}.
Every year, we’re given the opportunity to learn about the thousands of students
 who apply to {{config('app.name')}}, and it is never easy to narrow down such a diverse and passionate group
  of individuals. With that being said, our decision is not a negative assessment of your skills
   or accomplishments, nor does it reflect your ability to build something incredible.
@endsection
 
@section('second')Thanks for your interest in {{config('app.name')}} .
 We encourage you to keep learning and building incredible things in your community.
@endsection
