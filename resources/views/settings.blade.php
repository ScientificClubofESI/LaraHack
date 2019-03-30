@extends('layouts.app')
@section('styles')
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/button.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/checkbox.min.css">
<link rel="stylesheet" href="{{asset('css/settings.css')}}">
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
                            <input type="checkbox" name="public" checked>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/checkbox.min.js"></script>

@endpush