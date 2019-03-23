@extends('layouts.app')

@section('styles')
    <link href="{{asset('css/statistics')}}">
@endsection

@section('content')
    <div class="container">
        <div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-around mb-5">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="chart">
                                        <!-- Chart wrapper -->
                                        <canvas id="myChart1" class="chart-canvas"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <h5>Decisions</h5>
                                    <p>Shows number of accepted , rejected , waiting and not viewed yet hackers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-around mb-5">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="chart">
                                        <!-- Chart wrapper -->
                                        <canvas id="myChart2" class="chart-canvas"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <h5>T-shirts</h5>
                                    <p>Shows number of T-shirt you must provide for each size</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-around mb-5">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="chart">
                                        <!-- Chart wrapper -->
                                        <canvas id="myChart3" class="chart-canvas"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <h5>Gender</h5>
                                    <p>Shows number of male and female hackers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-around mb-5">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="chart">
                                        <!-- Chart wrapper -->
                                        <canvas id="myChart4" class="chart-canvas"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <h5>Inscriptions</h5>
                                    <p>Shows the amount of inscription per day </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

@endsection

@push('js')
    <!--<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>-->
    <script src="{{asset('argon/vendor/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('argon/vendor/chart.js/dist/Chart.extension.js')}}"></script>
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
                    backgroundColor: ["#f1fdf3", "#e5f4e7", "#d1e9d2", "#99cda9"]
                }]
            }
        });


        const chart2 = new Chart(ctx2, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: ["XL", "L", "M", "S"],
                datasets: [{
                    data: [{{$size_chart['XL']}},{{$size_chart['XL']}},{{$size_chart['XL']}},{{$size_chart['XL']}}],
                    backgroundColor: ["#048998", "#3bb4c1", "#e9e4e6", "#f6f5f5"]
                }]
            },

            // Configuration options go here
            options: {}
        });

        const chart3 = new Chart(ctx3, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: ["Male", "Female"],
                datasets: [{
                    data: [{{$gender_chart['male']}}, {{$gender_chart['female']}}],
                    backgroundColor: ["#ffa1ac", "#b7fbff"]
                }]
            },

            // Configuration options go here
            options: {}
        });

        const chart4 = new Chart(ctx4, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: [
                    @foreach(array_keys($inscription_date_chart) as $date)
                        '{{$date}}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Inscription per day',
                    backgroundColor: '#87c0cd',
                    borderColor: '#87c0cd',
                    data: [
                        @foreach($inscription_date_chart as $value)
                            '{{$value}}',
                        @endforeach
                    ]
                }]
            },

            // Configuration options go here
            options: {}

        });
    </script>
@endpush