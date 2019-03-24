@extends('layouts.app')

@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
    <link href="{{asset('css/statistics.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container pt-3 pb-7">
        <div class="row justify-content-center pb-3">
            <h1 class="text-black font-weight-900 text-xl">Statistics</h1>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <script>
        const ctx1 = document.getElementById('myChart1').getContext('2d');
        const ctx2 = document.getElementById('myChart2').getContext('2d');
        const ctx3 = document.getElementById('myChart3').getContext('2d');
        const ctx4 = document.getElementById('myChart4').getContext('2d');

        const chart = new Chart(ctx1, {
            type: "doughnut",
            data: {
                labels: ["Accepted", "Rejected", "Waiting list", "Not viewed yet"],
                datasets: [{
                    label: "My First Dataset",
                    data: [{{$decision_chart['accepted']}},{{$decision_chart['rejected']}}, {{$decision_chart['waiting']}},{{$decision_chart['not_yet']}}],
                    backgroundColor: ["#006d18", "#810016", "#004a9e", "#f7b633"]
                }]
            }, 
            options: {
                maintainAspectRatio : false , 
				legend: {
					display : false ,
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
        });


        const chart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ["XL", "L", "M", "S"],
                datasets: [{
                    data: [{{$size_chart['XL']}},{{$size_chart['L']}},{{$size_chart['M']}},{{$size_chart['S']}}],
                    backgroundColor: ["#f7de1c", "#2c3848", "#706381", "#45b7b8"]
                }]
            },
            options: {
                maintainAspectRatio : false , 
				legend: {
					display : false ,
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
        });

        const chart3 = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: ["Male", "Female"],
                datasets: [{
                    data: [{{$gender_chart['male']}}, {{$gender_chart['female']}}],
                    backgroundColor: ["#3476f9", "#ff5baa"]
                }]
            },
            options: {
                maintainAspectRatio : false , 
				legend: {
					display : false ,
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
        });

        const chart4 = new Chart(ctx4, {
            type: 'line',
            data: {
                labels: [
                    @foreach(array_keys($inscription_date_chart) as $date)
                        '{{$date}}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Inscription per day',
                    backgroundColor: 'transparent',
                    borderColor: '#004a9e',
                    data: [
                        @foreach($inscription_date_chart as $value)
                            '{{$value}}',
                        @endforeach
                    ]
                }]
            },
            	options: {
                    maintainAspectRatio : false , 
                    responsive: true,
				legend: {
					display : false ,
				},
				animation: {
					animateScale: true,
					animateRotate: true
				} ,
			},
        });
    </script>
@endpush