@extends('adminlte::page')

@section('title', 'Unidades do Orçamento')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Unidades do Orçamento</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('plans.show', $budgetPlan) }}">Plano Orçametário</a></li>
                <li class="breadcrumb-item active">Unidades do Orçamento'</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('plans.unit.create', $budgetPlan) }}" class="btn btn-success">
                            <i class="fa fa-plus"></i>
                            Adicionar
                        </a>
                    </div>
                    <div class="col">
                        <form method="GET" action={{ route('plans.index') }}>
                            <div class="input-group input-group-lg">
                                <input type="text" value="{{ request('q') }}" name="q"
                                    class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Unidade</th>
                        @foreach ($budgetPlan->accountingYears as $accountingYear)
                            <th> {{ $accountingYear->year }}</th>
                        @endforeach
                        <th>Status</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($predictedUnits as $predictedUnit)
                        <tr>
                            <td>{{ $predictedUnit->id }}</td>
                            <td>{{ $predictedUnit->unit->name }}</td>
                            <td>{{ date('d/m/Y', strtotime($predictedUnit->beginning_term)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($predictedUnit->end_period)) }}</td>
                            <td>
                                <span class="{{ $predictedUnit->status ? 'text-success' : 'text-danger' }}">
                                    {{ $predictedUnit->status ? 'Ativo' : 'Desativado' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('plans.show', $predictedUnit) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-folder"></i>
                                    Ver
                                </a>
                                <a href="{{ route('plans.edit', $predictedUnit) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                A Busca não retornou resultados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($predictedUnits->hasPages())
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $predictedUnits->links() }}
                </ul>
            </div>
        @endif
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
