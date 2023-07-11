<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetPlanRequest;
use App\Models\AccountingYear;
use App\Models\BudgetPlan;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class BudgetPlanController extends Controller
{
    function show(): View
    {
        if (request('q')) {
            $data = request('q');
            $budgetPlans = BudgetPlan::where('name', 'like', $data . '%');
            $budgetPlans = $budgetPlans->paginate(15);
        } else {
            $budgetPlans = BudgetPlan::paginate(15);
        }

        return view('config.plans.index', ['budgetPlans' => $budgetPlans]);
    }

    function create(): View
    {
        return view('config.plans.create');
    }

    function store(BudgetPlanRequest $request)
    {
        $request = $request->all();

        $save = BudgetPlan::create($request);
        if ($save) {
            Alert::success('Plano Orçamentário', 'Criado com sucesso');
            return redirect()->route('plans.index');
        }
        Alert::error('Plano Orçamentário', 'Erro ao criar');
        return redirect()->back();
    }

    public function details(BudgetPlan $budgetPlan): View
    {
        return view('config.plans.show', ['budgetPlan' => $budgetPlan]);
    }
    
    public function edit(BudgetPlan $budgetPlan) : View {
        
        return view('config.plans.edit', ['budgetPlan' => $budgetPlan]);
    }

    public function update(BudgetPlan $budgetPlan, BudgetPlanRequest $request){
        
        $request = $request->all();
        $budgetPlan = BudgetPlan::find($budgetPlan->id);
        $update = $budgetPlan->update($request);
        if ($update) {
            Alert::success('Plano Orçamentário', 'Atualizado com sucesso');
            return redirect()->route('plans.index');
        }
        Alert::error('Plano Orçamentário', 'Erro ao Atualizar');
        return redirect()->back();
    }
}
