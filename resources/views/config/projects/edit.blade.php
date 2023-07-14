@extends('adminlte::page')

@section('title', 'Projetos - Editar ' . $project->cod)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar Projeto</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projetos</a></li>
                <li class="breadcrumb-item active">Editar Projeto</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('projects.update',  $project) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="cod">Código</label>
                    <input type="text" class="form-control" name="cod" placeholder="1.2.3.4.5.6"
                        value="{{ old('cod', $project->cod) }}">
                    @error('cod')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Nome do Projeto</label>
                    <input type="text" class="form-control" name="description" placeholder="Contratação de Serviços"
                        value="{{ old('description', $project->description) }}">
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Unidade Orçamentária</label>
                    <select class="form-control" name="budget_unit_id" value="{{ old('budget_unit_id') }}">
                        @foreach ($budgetUnits as $budgetUnit)
                            <option value="{{ $budgetUnit->id }}" @if (old('budget_unit_id') == $budgetUnit->id) selected @endif>{{ $budgetUnit->acronym . ' - '. $budgetUnit->description }}</option>
                        @endforeach
                    </select>
                    @error('budget_unit_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="1" @if (old('status', $project->status)) selected @endif>Ativo</option>
                        <option value="0" @if (!old('status', $project->status)) selected @endif>Desativado</option>
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
