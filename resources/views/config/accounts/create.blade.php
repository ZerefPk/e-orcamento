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

        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="acronym">Tipo</label>
                    <select class="form-control" name="status" value="{{ old('type') }}">
                        <option value="1">Despesa de Capital</option>
                        <option value="1">Despesa Corrente</option>
                    </select>
                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="accounts">Contas [COD DESCRIÇÃO ]</label>
                    <textarea type="text" class="form-control" name="accounts" placeholder="252 ABC"> {{ old('accounts') }} </textarea>
                    @error('accounts')
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
