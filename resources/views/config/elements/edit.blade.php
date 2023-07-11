@extends('adminlte::page')

@section('title', 'Elementos de Despesas - Editar '.$expenseElement->cod)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar Elemento</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('elements.index') }}">Elementos de Despesas</a></li>
                <li class="breadcrumb-item active">Editar Elemento</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">

        <form method="POST" action="{{route('elements.update', $expenseElement)}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="account">Conta Contábil</label>
                    <input type="text" class="form-control" disabled name="account" disabled
                        value="{{$expenseElement->financialAccount->cod}} - {{$expenseElement->financialAccount->description}}">
                    
                </div>
                <div class="form-group">
                    <label for="cod">Código</label>
                    <input type="text" class="form-control" disabled name="cod" placeholder="Código"
                        value="{{ $expenseElement->cod}}">
                    
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input type="text" class="form-control" name="description" placeholder="Nome completo da unidade"
                        value="{{old('description', $expenseElement->description)}}">
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" value="{{ old('status') }}">
                        <option value="1" @if(old('status', $expenseElement->status))  selected @endif>Ativo</option>
                        <option value="0" @if(!old('status', $expenseElement->status))  selected @endif>Desativado</option>
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
