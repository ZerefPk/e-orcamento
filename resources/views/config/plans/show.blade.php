@extends('adminlte::page')

@section('title', 'Planos Orçamentarios - detalhe ' . $budgetPlan->name)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Plano Orçamentario - detalhes</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('budget-unit.index') }}">Planos Orçamentários</a></li>
                <li class="breadcrumb-item active">Plano Orçamentário - detalhes</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h3 class="text-center">{{ $budgetPlan->name }}</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Inicio</b> <a class="float-right">
                                {{ date('m/d/Y', strtotime($budgetPlan->beginning_term)) }}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Fim</b> <a class="float-right">
                                {{ date('m/d/Y', strtotime($budgetPlan->end_period)) }}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b> <a class="float-right">
                                {{ $budgetPlan->status ? 'Ativado' : 'Desativado' }}
                            </a>
                        </li>

                    </ul>
                    <a href="{{ route('plans.editAccountingYears', $budgetPlan) }}"
                        class="btn btn-primary btn-block"><b>Atualizar Anos Contábeis</b>
                    </a>
                    <a href="{{ route('budget-unit.edit', $budgetPlan) }}"
                        class="btn btn-primary btn-block"><b>Editar</b>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#graphs" data-toggle="tab">
                                Distribuição do Orçamento
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#budgets" data-toggle="tab">
                                Orçamentos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#unocs" data-toggle="tab">
                                Unidades Orçamentárias
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="graphs">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Destribuição do Orçamento</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">
                                                R$ {!! number_format($budgetPlan->accountingYears->sum('expected_budget'), 2, ',', '.') !!}

                                            </span>
                                            <span>Orçamento Previsto</span>
                                        </p>
                                        <p class="ml-auto d-flex flex-column text-right">
                                            <span class="text-success">
                                                <i class="fas fa-arrow-up"></i>R$ 80.000.00 - 33.1%
                                            </span>
                                            <span class="text-muted">Oçamento Estimado</span>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col">

                                            <div class="small-box bg-red">
                                                <div class="inner">
                                                    <span class="text-bold text-lg">R$ 58.000.00</span>
                                                    <p>Pessoal</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-users"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">Mais Informações<i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>

                                        <div class="col">

                                            <div class="small-box bg-primary">
                                                <div class="inner">
                                                    <span class="text-bold text-lg">R$ 58.000.00</span>
                                                    <p>Serviços</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-cogs"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">Mais Informaçõe <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>

                                        <div class="col">

                                            <div class="small-box bg-gray">
                                                <div class="inner">
                                                    <span class="text-bold text-lg">R$ 58.000.00</span>
                                                    <p>Materiais</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-store-alt"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">Mais Informaçõe <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="budget-allocation" height="200"
                                    style="display: block; width: 735px; height: 200px;" width="735"
                                    class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-red"></i> Pessoal
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Materiais
                                </span>
                                <span>
                                    <i class="fas fa-square text-gray"></i> Serviços
                                </span>
                            </div>

                        </div>
                        <div class="tab-pane" id="budgets">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Anos Orçamentários</h3>
                                </div>

                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Ano</th>
                                                <th>Orçamento Previsto</th>
                                                <th>Orçamento Estimado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($budgetPlan->accountingYears as $accountingYear)
                                                <tr>
                                                    <td>{{ $accountingYear->year }}</td>
                                                    <td>
                                                        R$
                                                        {{ number_format($accountingYear->expected_budget, 2, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        58514884
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="unocs">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Unidades Orçamentárias</h3>
                                </div>

                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>2024</th>
                                                <th>2025</th>
                                                <th>2026</th>
                                                <th>2027</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Update software</td>
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
            var budgetAllocation = $('#budget-allocation')
            var budgetAllocation = new Chart(budgetAllocation, {
                type: 'bar',
                data: {
                    labels: {!! $budgetPlan->accountingYears->pluck('year') !!},
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

        })
    </script>
@stop
