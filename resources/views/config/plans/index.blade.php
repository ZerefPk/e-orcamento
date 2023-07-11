@extends('adminlte::page')

@section('title', 'Planos Orçamentarios ')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Planos Orçamentarios </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Planos Orçamentarios</li>
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
                        <a href="{{ route('plans.create') }}" class="btn btn-success">
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
                        <th>Plano</th>
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Status</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($budgetPlans as $budgetPlan)
                        <tr>
                            <td>{{ $budgetPlan->id }}</td>
                            <td>{{ $budgetPlan->name }}</td>
                            <td>{{ date('d/m/Y', strtotime($budgetPlan->beginning_term)) }}</td>
                            <td>{{date('d/m/Y', strtotime( $budgetPlan->end_period)) }}</td>
                            <td>
                                <span class="{{ $budgetPlan->status ? 'text-success' : 'text-danger' }}">
                                    {{ $budgetPlan->status ? 'Ativo' : 'Desativado' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('plans.show', $budgetPlan) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-folder"></i>
                                    Ver
                                </a>
                                <a href="{{ route('plans.edit', $budgetPlan) }}" class="btn btn-info btn-sm">
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
        @if ($budgetPlans->hasPages())
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $budgetPlans->links() }}
                </ul>
            </div>
        @endif
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
