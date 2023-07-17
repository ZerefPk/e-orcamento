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
                <li class="breadcrumb-item active">Atualizar Anos Contábeis ({{ $budgetPlan->name }})</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="text-bold">{{ $budgetPlan->name }}</h5>
        </div>
        <form method="POST" action="{{ route('plans.unit.store', $budgetPlan) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="unit">Unidade Orçamentaria</label>
                    <select name="unit" class="form-control">
                        <option value="" disabled selected>Selecione</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}"> {{ $unit->acronym }} - {{ $unit->description }}</option>
                        @endforeach
                    </select>
                    @error('unit')
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
                @forelse ($budgetPlan->accountingYears as $accountingYear)
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for={{ 'percentage-' . $accountingYear->year }}>Porcetagem
                                    Presvita {{ $accountingYear->year }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="number" class="form-control percentage-input" min="0"
                                        max="100" id={{ 'percentage-' . $accountingYear->year }}
                                        name={{ 'percentage-' . $accountingYear->year }} placeholder="123.00"
                                        value="{{ old('percentage-' . $accountingYear->year) }}">
                                </div>

                                @error('percentage-' . $accountingYear->year)
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-1">
                            <p>OU</p>
                        </div>
                        <div class="col-7">
                            <div class="form-group">
                                <label for={{ 'expected_budget-' . $accountingYear->year }}>Valor
                                    Presvito {{ $accountingYear->year }}</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </div>
                                    <input type="number" class="form-control expected-budget-input" min="0"
                                        id={{ 'expected_budget-' . $accountingYear->year }}
                                        name={{ 'expected_budget-' . $accountingYear->year }} placeholder="123.00"
                                        value="{{ old('expected_budget-' . $accountingYear->year) }}">
                                </div>
                                @error('expected_budget-' . $accountingYear->year)
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                @empty
                    <p>O plano orçamentário <b>{{ $budgetPlan->name }}</b> não está inserido em nenhum ano contábil.</p>
                @endforelse
            </div>

            <div class="card-footer">
                <button type="reset" class="btn btn-wwarning">Limpar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        const baseValues = {
            @foreach ($budgetPlan->accountingYears as $accountingYear)
                {{ $accountingYear->year }}: {{ $accountingYear->expected_budget }},
            @endforeach
        };

        function calculateValues() {
            const percentageInputs = document.querySelectorAll('.percentage-input');
            const expectedBudgetInputs = document.querySelectorAll('.expected-budget-input');

            percentageInputs.forEach((percentageInput) => {
                const year = percentageInput.getAttribute('id').split('-')[1];
                const percentage = parseFloat(percentageInput.value);

                if (!isNaN(percentage)) {
                    const baseValue = baseValues[year];
                    if (baseValue) {
                        const calculatedValue = (percentage / 100) * baseValue;
                        const expectedBudgetInput = document.getElementById('expected_budget-' + year);
                        expectedBudgetInput.value = calculatedValue.toFixed(2);
                    }
                } else {
                    // If percentage input is empty, clear the corresponding expected budget input
                    const expectedBudgetInput = document.getElementById('expected_budget-' + year);
                    //expectedBudgetInput.value = '';
                }
            });

            expectedBudgetInputs.forEach((expectedBudgetInput) => {
                const year = expectedBudgetInput.getAttribute('id').split('-')[1];
                const expectedBudget = parseFloat(expectedBudgetInput.value);

                if (!isNaN(expectedBudget)) {
                    const baseValue = baseValues[year];
                    if (baseValue) {
                        const calculatedPercentage = (expectedBudget / baseValue) * 100;
                        const percentageInput = document.getElementById('percentage-' + year);
                        percentageInput.value = calculatedPercentage.toFixed(2);
                    }
                } else {
                    // If expected budget input is empty, clear the corresponding percentage input
                    const percentageInput = document.getElementById('percentage-' + year);
                    percentageInput.value = '';
                }
            });
        }

        // Event to trigger the calculateValues function when the page is loaded
        window.addEventListener('load', calculateValues);

        // Event to trigger the calculateValues function when the input fields are changed
        const inputs = document.querySelectorAll('.percentage-input, .expected-budget-input');
        inputs.forEach(input => {
            input.addEventListener('change', calculateValues);
        });
    </script>
@stop
