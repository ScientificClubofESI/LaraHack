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
                    <span> Registrations are closed ! </span>
            </div>
        </div>
    </div>
@endsection