@extends('layouts.app')

@section('styles')
    <link href="{{asset('css/statistics')}}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-lg-6">
                <canvas id="myChart1"></canvas>
                <div class="row justify-content-center">
                    <p class="font-weight-bold">The first chart</p>
                </div>
            </div>
            <div class="col-lg-6">
                <canvas id="myChart2"></canvas>
                <div class="row justify-content-center">
                    <p class="font-weight-bold">The second chart</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="col-lg-6">
                <canvas id="myChart3"></canvas>
                <div class="row justify-content-center">
                    <p class="font-weight-bold">The third chart</p>
                </div>
            </div>
            <div class="col-lg-6">
                <canvas id="myChart4"></canvas>
                <div class="row justify-content-center">
                    <p class="font-weight-bold">The fourth chart</p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        const ctx1 = document.getElementById('myChart1').getContext('2d');
        const ctx2 = document.getElementById('myChart2').getContext('2d');
        const ctx3 = document.getElementById('myChart3').getContext('2d');
        const ctx4 = document.getElementById('myChart4').getContext('2d');

        const chart = new Chart(ctx1, {
            type: "doughnut",
            data: {
                labels: ["Red", "Blue", "Yellow"],
                datasets: [{
                    label: "My First Dataset",
                    data: [300, 50, 100],
                    backgroundColor: ["rgb(0, 99, 132)", "rgb(254, 162, 235)", "rgb(255, 25, 86)"]
                }]
            }
        });


        const chart2 = new Chart(ctx2, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: ["Red", "Blue", "Yellow"],
                datasets: [{
                    label: "My First Dataset",
                    data: [300, 50, 100],
                    backgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"]
                }]
            },

            // Configuration options go here
            options: {}
        });

        const chart3 = new Chart(ctx3, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(99, 132, 155)',
                    borderColor: 'rgb(99, 132, 155)',
                    data: [0, 10, 5, 20, 0, 30, 25]
                }]
            },

            // Configuration options go here
            options: {}
        });

        const chart4 = new Chart(ctx4, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(132, 199, 255)',
                    borderColor: 'rgb(132, 199, 255)',
                    data: [30, 10, 5, 25, 20, 0, 45]
                }]
            },

            // Configuration options go here
            options: {}
        });
    </script>
@endsection