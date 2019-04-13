@extends('layouts.dashboard.app')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/checkbox.min.css">
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
                        <div class="ui toggle checkbox">
                            <input id="registration" @if($settings->get('registration_mode') == 'open') checked @endif type="checkbox"
                            name="public" onclick="updateSettings(this)">
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
<!-- Sweet Alert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Update Settings JS -->
<script>
    'use strict';
    const token = '{{csrf_token()}}';
</script>
<script src="{{asset('js/dashboard/update-settings.js')}}"></script>

@endpush