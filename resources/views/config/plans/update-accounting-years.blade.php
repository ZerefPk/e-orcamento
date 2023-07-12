@extends('adminlte::page')

@section('title', 'Plano Orçamentário - Inserir')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Atualizar Anos Contábeis</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('budget-unit.index') }}">Planos Orçamentários</a></li>
                <li class="breadcrumb-item active">Atualizar Anos Contábeis ({{$budgetPlan->name}})</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('plans.updateAccountingYears', $budgetPlan) }}">
            @csrf
            <div class="card-body">
                @forelse ($budgetPlan->accountingYears as $accountingYear)
                    <div class="form-group">
                        <label for={{"year-" . $accountingYear->year}}>{{ $accountingYear->year }}</label>
                        <input type="text" class="form-control" id={{"year-" . $accountingYear->year}} name={{"year-" . $accountingYear->year}} placeholder="123.00"
                            value="{{ old('year-' . $accountingYear->year, $accountingYear->expected_budget) }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                @empty
                    <p>O plano orçamentário <b>{{ $budgetPlan->name }}</b> não está inserido em nenhum ano contábil.</p>
                @endforelse
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
