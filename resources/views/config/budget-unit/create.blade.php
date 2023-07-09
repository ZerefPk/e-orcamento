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

        <form method="POST" action="{{route('budget-unit.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="acronym">Sigla</label>
                    <input type="text" class="form-control" name="acronym" placeholder="Sigla"
                        value="{{ old('acronym') }}">
                    @error('acronym')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input type="text" class="form-control" name="description" placeholder="Nome completo da unidade"
                        value="{{ old('description') }}">
                    @error('description')
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
