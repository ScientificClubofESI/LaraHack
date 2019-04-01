@extends('layouts.main.default')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="home-title">

            <div class="row not-typed">
                <div class="col-12">
                    <img class="logo-img" src="{{asset('images/LOGO.png')}}" alt="{{config('app.name')}}">
                </div>
            </div>
            <div class="row justify-content-center come">
                @if($result)
                    <span>Thank's for confirming your attendance to {{ config('app.name')}} ! We are waiting for you</span>
                @else
                    <span>Oh sorry , that's an unexpected error. Try again please !</span>
                @endif
            </div>
        </div>
    </div>
@endsection