<?php

namespace App\Http\Controllers;

use App\Models\BudgetPlan;
use App\Models\BudgetUnit;
use App\Models\PredictedUnit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PredictedUnitController extends Controller {
    //
    public function dataValidate(BudgetPlan $budgetPlan): array {

        $rules = ['unit' => 'required', 'status' => 'required'];
        $attributes = ['unit' => '[Unidade Orçamentaria]', 'status' => '[status]'];

        foreach ($budgetPlan->accountingYears as $accountingYear) {
            $percentage = 'percentage-'.$accountingYear->year;
            $percentageAtt = '[Porcentagem Prevista '.$accountingYear->year.']';
            $expected_budget = 'expected_budget-'.$accountingYear->year;
            $expected_budgetAtt = '[Valor previsto '.$accountingYear->year.']';

            $rules = $rules + [$percentage => 'nullable|numeric|min:0|max:100'];
            $attributes = $attributes + [$percentage => $percentageAtt];
            $rules = $rules + [$expected_budget => 'nullable|numeric|min:0'];
            $attributes = $attributes + [$expected_budget => $expected_budgetAtt];
        }

        return [
            'rules' => $rules,
            'attributes' => $attributes,
        ];
    }

    public function show(BudgetPlan $budgetPlan): View {
        if (request('q')) {
            $data = request('q');

            $predictedUnits = PredictedUnit::where('budget_unit_id', 'like', $data.'%');
            $predictedUnits = $predictedUnits->paginate(15);
        } else {
            $predictedUnits = PredictedUnit::paginate(15);
        }

        return view('budget-plan.unit.index', ['budgetPlan' => $budgetPlan, 'predictedUnits' => $predictedUnits]);

    }

    public function create(BudgetPlan $budgetPlan): View {
        $units = BudgetUnit::where('status', true)->get();

        return view('budget-plan.unit.create', ['budgetPlan' => $budgetPlan, 'units' => $units]);
    }

    public function store(BudgetPlan $budgetPlan, Request $request) {
        $dataValidate = $this->dataValidate($budgetPlan);
        //dd($makeValidate);
        $validator = Validator::make(
            $data = $request->all(),
            $rules = $dataValidate['rules'],
            $messages = [],
            $attributes = $dataValidate['attributes'],

        )->validate();
        $formDatas = $request->all();
        foreach ($formDatas as $data) {
            $key1 = 'expected_budget-'.$budgetPlan->accountingYear->year;
            $key2 = 'percentage-'.$budgetPlan->accountingYear->year;
            $save = PredictedUnit::create([
                'budget_unit_id' => $data['unit'],
                'accounting_year_id' => $budgetPlan->accountingYear->id,
                'expected_budget' => $data[$key1],
                'percentage' => $data[$key2],
                'status' => $data['status'],
            ]);

        }

    }
}
