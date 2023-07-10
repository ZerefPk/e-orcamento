@extends('adminlte::page')

@section('title', 'Contas Contábeis - Editar '.$financialAccount->cod)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar Conta</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Contas Contábeis</a></li>
                <li class="breadcrumb-item active">Editar Conta</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">

        <form action="{{route('accounts.update', $financialAccount)}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="a">Código</label>
                    <input name="a"
                    type="text"
                    disabled
                    class="form-control input-disabled" 
                    value="{{$financialAccount->cod}}" 
                    >
    
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input type="text" class="form-control" name="description" placeholder="Descrição da Conta"
                        value="{{ (old('description')) ? old('description'): $financialAccount->description}}">
                    @error('description')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type">Tipo</label>
                    <select class="form-control" name="type">
                        
                        <option value="1" @if(old('type', $financialAccount->type))  selected @endif>Despesa de Capital</option>
                        <option value="0" @if(!old('type', $financialAccount->type))  selected @endif>Despesa Corrente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status">
                        <option value="1" @if(old('status', $financialAccount->status))  selected @endif>Ativo</option>
                        <option value="0" @if(!old('status', $financialAccount->status))  selected @endif>Desativado</option>
                    </select>
                    @error('status')
                        <p class="text-danger">{{$message}}</p>
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
