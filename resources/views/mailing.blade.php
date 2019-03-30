@extends('layouts.app') 
@section('styles')
<link rel="stylesheet" href="{{asset('css/mailing.css')}}">
@endsection
 
@section('content')
<div class="container pt-3 pb-7">
    <div class="row justify-content-center">
        <div class="col-md-10 pb-3">
            <h1 class="text-center font-weight-900 text-xl"> Mailing Tool </h1>
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
                            {{--
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> --}}
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
                            {{--
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> --}}
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
                            {{--
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> --}}
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
     function sendMail(element, mailType) {
         swal({
             title : "Are you sure to send mails ?" ,
             text: "Once sent, you will not be able to redo!",
             icon :"warning" ,
             buttons : true , 
         }) 
         .then((willSend) => { 
             if (willSend) {
                $.ajax({
                headers:{'X-CSRF-TOKEN': token},
                type:"POST",
                url:"{{route('sendMail')}}",
                dataType:'json',
                data: JSON.stringify({MailType : mailType}),
                contentType:false,
                processData:false,
                beforeSend: function () {
                    element.innerHTML = '<svg class="spinner" width="15px" height="15px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"> <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle> </svg>';                    
                },
                success: function (json) {
                    //set the changes
                    if (json.response) {                        
                    }
                    $(document.body).css({'cursor': 'default'});
                    element.innerHTML = '<i class="fas fa-envelope"></i>';
                    swal ( "Done !" ,  "Mails are being sent , it can takes some minutes ." ,  "success" );
                },
                error: function (response) {
                    if (response.status === 401) //redirect if not authenticated user.
                        window.location = '/errors/401';
                    else if (response.status === 422) {
                    } else {
                    }
                    $(document.body).css({'cursor': 'default'});
                    element.innerHTML = '<i class="fas fa-envelope"></i>';
                    swal ( "Oops" ,  "Something went wrong!" ,  "error" )
                }
            })
             } else {
                swal("You havn't send any mail !");
             }
         })
       
     }
</script>

@endpush