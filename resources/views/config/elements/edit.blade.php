@extends('adminlte::page')

@section('title', 'Elementos de Despesas - Editar')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar Elemento</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Elementos de Despesas</a></li>
                <li class="breadcrumb-item active">Editar Elemento</li>
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
                    <input type="text" class="form-control" disabled name="account" placeholder="45584,555,5545"
                        value="{{ old('account') }}">
                    @error('account')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="acronym">Código</label>
                    <input type="text" class="form-control" disabled name="cod" placeholder="Código"
                        value="{{ old('cod') }}">
                    @error('cod')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input type="text" class="form-control" name="description" placeholder="Nome completo da unidade"
                        value="{{ old('description') }}">
                    @error('description')
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
