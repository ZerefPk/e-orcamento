@extends('adminlte::page')

@section('title', 'Elementos de Despesas - Detalhes')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Elementos de Despesas - detalhes</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('elements.index') }}">Elementos de Despesas</a></li>
                <li class="breadcrumb-item active">Elementos de Despesas - detalhes</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">

                    <h3 class="profile-username text-center">422.4.578.2</h3>
                    <p class="text-muted text-center">Diretoria de Tencologia da Informação</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Status</b> <a class="float-right">Ativo</a>
                        </li>

                        <li class="list-group-item">
                            <b>Plano</b>
                            <div class="float-right">
                                <select name="" id="" class="form-control">
                                    <option value="">2023-2027</option>
                                </select>
                            </div>
                        </li>


                    </ul>
                    <a href="{{ route('elements.edit') }}" class="btn btn-primary btn-block"><b>Editar</b></a>
                </div>

            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Contratação</th>
                                <th>2024</th>
                                <th>2025</th>
                                <th>2026</th>
                                <th>2027</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>03 - abs</td>
                                <td>
                                    58514884
                                </td>
                                <td>
                                    58514884
                                </td>
                                <td>
                                    58514884
                                </td>
                                <td>
                                    58514884
                                </td>
                            </tr>
                            <tr class="text-bold">
                                <td>Total</td>
                                <td>
                                    58514884
                                </td>
                                <td>
                                    58514884
                                </td>
                                <td>
                                    58514884
                                </td>
                                <td>
                                    58514884
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        $(function() {
            'use strict'
            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }
            var mode = 'index'
            var intersect = true
            var $budgetAllocation = $('#budget-allocation')
            var budgetAllocation = new Chart($budgetAllocation, {
                type: 'bar',
                data: {
                    labels: ['2024', '2025', '2026', '2027'],
                    datasets: [{
                        backgroundColor: '#dc3545',
                        borderColor: '#dc3545',
                        data: [10000, 10000, 10000, 10000]
                    }, {
                        backgroundColor: '#007bff',
                        borderColor: '#007bff',
                        data: [1000, 2000, 3000, 2500]
                    }, {
                        backgroundColor: '#ced4da',
                        borderColor: '#ced4da',
                        data: [700, 1700, 2700, 2000, ]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                callback: function(value) {
                                    if (value >= 1000) {
                                        value /= 1000
                                        value += 'k'
                                    }
                                    return '$' + value
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
            var $visitorsChart = $('#visitors-chart')
            var visitorsChart = new Chart($visitorsChart, {
                data: {
                    labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
                    datasets: [{
                        type: 'line',
                        data: [100, 120, 170, 167, 180, 177, 160],
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        pointBorderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                        fill: false
                    }, {
                        type: 'line',
                        data: [60, 80, 70, 67, 80, 77, 100],
                        backgroundColor: 'tansparent',
                        borderColor: '#ced4da',
                        pointBorderColor: '#ced4da',
                        pointBackgroundColor: '#ced4da',
                        fill: false
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: 200
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        })
    </script>
@stop
