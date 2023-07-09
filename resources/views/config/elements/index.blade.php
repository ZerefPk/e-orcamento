@extends('adminlte::page')

@section('title', 'Elementos de Despesas')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Elementos de Despesas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
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
                        <a href="{{route('elements.create')}}" class="btn btn-success">
                            <i class="fa fa-plus"></i>
                            Adicionar
                        </a>
                    </div>
                    <div class="col">
                        <div class="input-group input-group-lg">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
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
                    <tr>
                        <td>1</td>
                        <td>4.1.4.2.4</td>
                        <td>Diretoria de Tecnologia da Informação e Comunicação</td>
                        <td><span class="tag tag-success">Ativo</span></td>
                        <td>
                            <a href="{{route('elements.show')}}" class="btn btn-primary btn-sm">
                                <i class="fas fa-folder"></i>
                                Ver
                            </a>
                            <a href="{{route('elements.edit')}}" class="btn btn-info btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                                Editar
                            </a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </div>

    </div>
@stop

@section('css')
@stop

@section('js')

@stop
