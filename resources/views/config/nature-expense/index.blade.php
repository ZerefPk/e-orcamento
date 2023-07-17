@extends('adminlte::page')

@section('title', 'Naturezas das Despesas')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Naturezas das Despesas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Naturezas das Despesas</li>
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
                        <a href="{{ route('natureExpense.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i>
                            Adicionar
                        </a>
                    </div>
                    <div class="col">
                        <form method="GET" action={{ route('natureExpense.index') }}>
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
                        <th>COD</th>
                        <th>Descrição</th>
                        <th>Despesa</th>
                        <th>Status</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($natureExpenses as $natureExpense)
                        <tr>
                            <td>{{ $natureExpense->id }}</td>
                            <td>{{ $natureExpense->cod }}</td>
                            <td>{{ $natureExpense->description }}</td>
                            <td class="text-uppercase">
                                {{ $natureExpense->type ? 'Corrente' : 'Capital' }}

                            </td>
                            <td>
                                <span class="{{ $natureExpense->status ? 'text-success' : 'text-danger' }}">
                                    {{ $natureExpense->status ? 'Ativo' : 'Desativado' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('natureExpense.show', $natureExpense) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-folder"></i>
                                    Ver
                                </a>
                                <a href="{{ route('natureExpense.edit', $natureExpense) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">A busca não retornou resultados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($natureExpenses->hasPages())
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $natureExpenses->links() }}
                </ul>
            </div>
        @endif
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
