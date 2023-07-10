@extends('adminlte::page')

@section('title', 'Contas Contábeis - Inserir')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Inserir Projeto</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Contas Contábeis</a></li>
                <li class="breadcrumb-item active">Inserir Conta</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">

        <form method="POST" action={{ route('accounts.store') }} enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="accounts">Arquivo de Contas (.csv)</label>
                    <input type="file" accept=".csv" class="form-control" name="csv" value="{{ old('csv') }}" />
                    @error('csv')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Delimitador</label>
                    <select class="form-control" name="delimiter" value="{{ old('delimiter') }}">
                        <option value=";">Ponto e Vírgula (;)</option>
                        <option value=",">Vírgula (,)</option>
                    </select>
                    @error('delimiter')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
