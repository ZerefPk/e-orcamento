@extends('adminlte::page')

@section('title', 'Elementos de Despesas')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Elementos de Despesas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Elementos de Despesas</li>
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
                        <a href="{{ route('elements.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i>
                            Adicionar
                        </a>
                    </div>
                    <div class="col">
                        <form method="GET" action={{ route('elements.index') }}>
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
                        <th>Status</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenseElements as $expenseElement)
                        <tr>
                            <td>{{ $expenseElement->id }}</td>
                            <td>{{ $expenseElement->cod }}</td>
                            <td>{{ $expenseElement->description }}</td>
                            <td>
                                <span class="{{ $expenseElement->status ? 'text-success' : 'text-danger' }}">
                                    {{ $expenseElement->status ? 'Ativo' : 'Desativado' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('elements.show', $expenseElement) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-folder"></i>
                                    Ver
                                </a>
                                <a href="{{ route('elements.edit', $expenseElement) }}" class="btn btn-info btn-sm">
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
        @if ($expenseElements->hasPages())
            <div class="card-footer clearfix">
                <ul class="pagination m-0">
                    {{ $expenseElements->links() }}
                </ul>
            </div>
        @endif

    </div>
@stop

@section('css')
@stop

@section('js')

@stop
