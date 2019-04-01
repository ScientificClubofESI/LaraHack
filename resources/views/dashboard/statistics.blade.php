@extends('layouts.dashboard.app') 
@section('styles')
<link href="{{asset('css/statistics.css')}}" rel="stylesheet">
@endsection
 
@section('content')
<div class="container pt-3 pb-7">
    <div class="row justify-content-center pb-3">
        <h1 class="text-black font-weight-900 text-xl">Statistics</h1>
    </div>
    <div class="row justify-content-center pb-3">
        <h2 class="text-black font-weight-900 text-l">All Hackers </h2>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="h3 mb-0">Decisions</h5>
                    <h6 class="surtitle">Shows number of accepted , rejected , waiting and not viewed yet hackers</h6>
                </div>

                <div class="card-body">
                    <div class="chart">
                        <canvas id="myChart1" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">

                    <h5 class="h3 mb-0">Registration</h5>
                    <h6 class="surtitle">Shows the amount of registration per day</h6>

                </div>

                <div class="card-body">
                    <div class="chart">
                        <canvas id="myChart4" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center pb-3">
        <h2 class="text-black font-weight-900 text-l">Only Accepted Hackers </h2>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="h3 mb-0">Gender</h5>
                    <h6 class="surtitle">Shows number of male and female hackers </h6>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="myChart3" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="h3 mb-0">T-shirts</h5>
                    <h6 class="surtitle">Shows number of T-shirt you must provide for each size</h6>
                </div>

                <div class="card-body">
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="myChart2" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 @push('js')
<!-- Chart JS Script -->

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript">
    var decisionData = [ "{{$decision_chart['accepted']}}" ,
        "{{$decision_chart['rejected']}}" , 
        "{{$decision_chart['waiting']}}" ,
        "{{$decision_chart['not_yet']}}"
        ];

        var tshirtData = [
            "{{$size_chart['XL']}}",
            "{{$size_chart['L']}}",
            "{{$size_chart['M']}}",
            "{{$size_chart['S']}}"
        ];

        var genderData = [
            "{{$gender_chart['male']}}",
            "{{$gender_chart['female']}}"
        ];

        var registrationLabels = [
            @foreach(array_keys($inscription_date_chart) as $date)
                '{{$date}}',
            @endforeach
        ];

        var registrationData =  [
            @foreach($inscription_date_chart as $value)
                '{{$value}}',
            @endforeach
        ];
</script>
<script src="{{asset('js/dashboard/state.js')}}"></script>

@endpush