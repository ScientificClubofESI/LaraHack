@extends('layouts.dashboard.app') 
@section('styles')
<link rel="stylesheet" href="{{asset('css/mailing.css')}}">
@endsection
 
@section('content')
<div class="container pt-3 pb-7">
    <div class="row justify-content-center">
        <div class="col-md-10 pb-3">
            <h1 class="text-center font-weight-900 text-xl"> Mailing </h1>
        </div>
        <div class="row col-md-10">
            <div class="col">
                <div class="container">
                    <div class="card card-stats mb-4 mb-lg-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Accepted Hackers</h5>
                                    <span class="h2 font-weight-bold mb-0"> {{$accepted}} </span>
                                </div>
                                    <div class="col-auto " >
                                        <div  onclick="sendMail(this , 'accepted_mail')" class="hover icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col">
                <div class="container">
                    <div class="card card-stats mb-4 mb-lg-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Rejected Hackers</h5>
                                    <span class="h2 font-weight-bold mb-0"> {{$rejected}} </span>
                                </div>
                                    <div class="col-auto ">
                                        <div  onclick="sendMail(this , 'rejected_mail')" class="hover icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col">
                <div class="container">
                    <div class="card card-stats mb-4 mb-lg-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Waiting Hackers</h5>
                                    <span class="h2 font-weight-bold mb-0"> {{$waiting}} </span>
                                </div>
                                    <div class="col-auto ">
                                        <div  class="hover icon icon-shape bg-default text-white rounded-circle shadow" onclick="sendMail(this , 'waiting_mail')" >
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
 @push('js')
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    'use strict';
    const token='{{csrf_token()}}';
    const route = "{{route('sendMail')}}" ;
</script>
<script src="{{asset('js/dashboard/mail.js')}}"></script>
@endpush