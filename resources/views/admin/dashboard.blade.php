@extends('admin.layouts.home')
@section('content')
<div class="main-content">
    <div class="page-content">
        @if (Auth::user()->role === "admin")
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <!-- Information Cards -->
            <div class="row">
                <div class="col-sm-4">
                <div>
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header" style="background-color: #28183c">Clients</div>
                        <div class="card-body" style="border-radius: 0 0 10px 10px;">
                            <h5 class="card-title" style="color:white;">Total number</h5>
                            <p class="card-text">{{ $clientCount }}</p>
                        </div>
                    </div>
                </div>
                <!-- Mechanics Card -->
                <div >
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header" style="background-color: #28183c">Mechanics</div>
                        <div class="card-body" style="border-radius: 0 0 10px 10px;">
                            <h5 class="card-title" style="color:white;">Total number</h5>
                            <p class="card-text">{{ $mechanicCount }}</p>
                        </div>
                    </div>
                </div>
                <!-- Vehicles Card -->
                <div >
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header" style="background-color: #28183c">Vehicles</div>
                        <div class="card-body" style="border-radius: 0 0 10px 10px;">
                            <h5 class="card-title" style="color:white;">Total number</h5>
                            <p class="card-text">{{ $vehicleCount }}</p>
                        </div>
                    </div>
                </div>
                <!-- Appointments Today Card -->
                <div >
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header" style="background-color: #28183c">Appointments Today</div>
                        <div class="card-body" style="border-radius: 0 0 10px 10px;">
                            <h5 class="card-title" style="color:white;">Total number</h5>
                            <p class="card-text">{{ $appointmentCount }}</p>
                        </div>
                    </div>
                </div>
                <!--  Repairs Card -->
                <div >
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header" style="background-color: #28183c">Repairs</div>
                        <div class="card-body" style="border-radius: 0 0 10px 10px;">
                            <h5 class="card-title" style="color:white;">Total number</h5>
                            <p class="card-text">{{ $RepairsCount }}</p>
                        </div>
                    </div>
                </div>

                </div>
                <div class="col-sm-8">
                    <!-- Donut Chart for Repairs -->
                    <canvas id="repairsChart"></canvas>
                </div>
            </div>
        </div>
        @elseif (Auth::user()->role === "client")
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                
                <div class="col-sm-4">
                <div>
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header" style="background-color: #28183c">My vehicles</div>
                        <div class="card-body" style="border-radius: 0 0 10px 10px;">
                            <h5 class="card-title" style="color:white;">Total number</h5>
                            <p class="card-text">{{ $vehiculeById }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header" style="background-color: #28183c">My repairs</div>
                        <div class="card-body" style="border-radius: 0 0 10px 10px;">
                            <h5 class="card-title" style="color:white;">Total number</h5>
                            <p class="card-text">{{ $repairById }}</p>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-sm-8">
                    <!-- Donut Chart for Repairs -->
                    <canvas id="repairsChartById"></canvas>
                </div>
            </div>
        </div>
        @elseif (Auth::user()->role === "mechanic")
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-sm-4">
                <div>
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header" style="background-color: #28183c">My Assigned Repairs</div>
                        <div class="card-body" style="border-radius: 0 0 10px 10px;">
                            <h5 class="card-title" style="color:white;">Total number</h5>
                            <p class="card-text">{{ $pendingRepairsCountByIdM }}</p>
                        </div>
                    </div>
                </div>
                
                </div>
                <div class="col-sm-8">
                    <!-- Donut Chart for Repairs -->
                    <canvas id="repairsChartByIdM"></canvas>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- End Page-content -->

    <footer class="bg-body-tertiary text-center mt-30" style="bottom:0;position:fixed;left:150px;right:0;">
        <div class="text-center p-3" style="background-color:#28183c; display:flex;align-items:center;justify-content:flex-start;">
            <p style="color:white;text-align:center;margin:0 0 0 6rem;">Copyright © 2023 All rights reserved - Zayd Ftouh</p>
        </div>
    </footer>
</div>
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('repairsChart').getContext('2d');
        var repairsChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed Repairs', 'Pending Repairs'],
                datasets: [{
                    data: [{{ $completedRepairsCount }}, {{ $pendingRepairsCount }}],
                    backgroundColor: ['#ffff', '#28183c'],
                    hoverBackgroundColor: ['rgba(255, 255, 255, .3)', 'rgba(40, 24, 60, .3)'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                var total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                                var currentValue = tooltipItem.raw;
                                var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                                return currentValue + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('repairsChartById').getContext('2d');
        var repairsChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed Repairs', 'Pending Repairs'],
                datasets: [{
                    data: [{{ $completedRepairsCountById }}, {{ $pendingRepairsCountById }}],
                    backgroundColor: ['#ffff', '#28183c'],
                    hoverBackgroundColor: ['rgba(255, 255, 255, .3)', 'rgba(40, 24, 60, .3)'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                var total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                                var currentValue = tooltipItem.raw;
                                var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                                return currentValue + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('repairsChartByIdM').getContext('2d');
        var repairsChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed Repairs', 'Pending Repairs'],
                datasets: [{
                    data: [{{ $completedRepairsCountByIdM }}, {{ $pendingRepairsCountByIdM }}],
                    backgroundColor: ['#ffff', '#28183c'],
                    hoverBackgroundColor: ['rgba(255, 255, 255, .3)', 'rgba(40, 24, 60, .3)'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                var total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                                var currentValue = tooltipItem.raw;
                                var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                                return currentValue + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
