@extends('adminlte::page')

@section('title', 'Unidades Orçamentarias - Inserir')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Inserir Unidades Urçamentarias</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('budget-unit.index') }}">Unidades Orçamentaria</a></li>
                <li class="breadcrumb-item active">Inserir Unidades Orçamentaria</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('plans.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nome do Plano</label>
                    <input type="text" class="form-control" name="name" placeholder="Plano fantasia"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="beginning_term">Data de Inicio</label>
                    <input type="date" class="form-control" name="beginning_term" value="{{ old('beginning_term') }}">
                    @error('beginning_term')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end_period">Data de Término</label>
                    <input type="date" class="form-control" name="end_period" value="{{ old('end_period') }}">
                    @error('end_period')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" value="{{ old('status') }}">
                        <option value="1">Ativo</option>
                        <option value="0">Desativado</option>
                    </select>
                    @error('status')
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
