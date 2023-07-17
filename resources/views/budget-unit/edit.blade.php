@extends('adminlte::page')

@section('title', 'Unidades Orçamentarias - Editar '.$budgetUnit->acronym)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar Unidades Urçamentarias</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('budget-unit.index') }}">Unidades Orçamentaria</a></li>
                <li class="breadcrumb-item active">Editar Unidades Orçamentaria</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">

        <form method="POST" action="{{ route('budget-unit.update', $budgetUnit) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="acronym">Sigla</label>
                    <input type="text" class="form-control" name="acronym" placeholder="Sigla"
                        value="{{ old('acronym') ? old('acronym') : $budgetUnit->acronym }}">
                    @error('acronym')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input type="text" class="form-control" name="description" placeholder="Nome completo da unidade"
                        value="{{ old('description') ? old('description') : $budgetUnit->description }}">
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status">
                        <option value="1" @if(old('status', $budgetUnit->status)) selected @endif>Ativo</option>
                        <option value="0" @if(!old('status', $budgetUnit->status))  selected @endif>Desativado</option>
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
