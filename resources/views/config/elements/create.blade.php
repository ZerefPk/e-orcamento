@extends('adminlte::page')

@section('title', 'Elementos de Despesas - Inserir')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Inserir Elemento</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Elementos de Despesas</a></li>
                <li class="breadcrumb-item active">Inserir Elemento</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">

        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="acronym">Conta Contábil</label>
                    <select class="form-control" name="status" value="{{ old('account') }}">
                        <option value="1">25225.2552.222- Despesa</option>
                        <option value="1">Despesa Corrente</option>
                    </select>
                    @error('account')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="accounts">Elemento [COD DESCRIÇÃO ]</label>
                    <textarea type="text" class="form-control" name="elements" placeholder="252 ABC"> {{ old('elements') }} </textarea>
                    @error('elements')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" value="{{ old('status') }}">
                        <option>Ativo</option>
                        <option>Desativado</option>
                    </select>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
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
