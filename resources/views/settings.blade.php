@extends('layouts.app')
@section('styles')
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/button.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/checkbox.min.css">
{{-- <link rel="stylesheet" href="{{asset('css/settings.css')}}"> --}}
@endsection


@section('content')
<div class="container pt-3 pb-7">
    <div class="row justify-content-center">
        <div class="col-md-10 pb-3">
            <h1 class="text-center font-weight-900 text-xl"> Settings </h1>
        </div>
        <div class="row col-md-10">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h3 mb-0">
                            Registration Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        {{-- <div class="ui buttons ">
                            <div class="ui positive button">Open</div>
                            <div class="or"></div>
                            <div class="ui negative button">Closed</div>
                        </div>             --}}
                        <div class="ui toggle checkbox">
                            <input id="registration" 
                            @if($settings->get('registration_mode') == 'open')
                            checked
                            @endif 
                            type="checkbox" name="public" onclick="updateSettings(this)">
                            <label>Registration Open</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h3 mb-0">
                            Other Settings
                        </h5>
                    </div>
                    <div class="card-body">           
                    </div>
                </div>
            </div>
        </div>
            
    </div>
</div>
@endsection

@push('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/checkbox.min.js"></script>
<script>
    'use strict';
        const token='{{csrf_token()}}';
     function updateSettings(element) {
         if ( $('#registration').prop("checked") ) {
            var registrationMode = 'open'
         } else {
            var registrationMode = 'closed'
         }
         swal({
             title : "Are you sure to Update Settings ?" ,
             icon :"warning" ,
             buttons : true , 
         }) 
         .then((willUpdate) => { 
             if (willUpdate) {
                $.ajax({
                headers:{'X-CSRF-TOKEN': token},
                type:"POST",
                url:"{{route('updateSettings')}}",
                dataType:'json',
                data: JSON.stringify({ registration_mode : registrationMode}),
                contentType:false,
                processData:false,
                beforeSend: function () {
                },
                success: function (json) {
                    //set the changes
                    if (json.response) {                        
                    }
                    swal ( "Done !" ,  "Settings Updated Sucessefully" ,  "success" );
                },
                error: function (response) {
                    if (response.status === 401) //redirect if not authenticated user.
                        window.location = '/errors/401';
                    else if (response.status === 422) {
                    } else {
                    }
                    swal ( "Oops" ,  "Something went wrong!" ,  "error" )
                }
            })
             } else {
                swal("You havn't updated any setting !");
             }
         })
       
     }
</script>
@endpush