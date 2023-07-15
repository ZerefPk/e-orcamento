<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetUnitRequest;
use App\Models\BudgetUnit;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class BudgetUnitController extends Controller {
    public function show(): View {
        if (request('q')) {
            $data = request('q');
            $budgetUnits = BudgetUnit::where('acronym', 'like', $data.'%');
            $budgetUnits = $budgetUnits->paginate(15);
        } else {
            $budgetUnits = BudgetUnit::paginate(15);
        }

        return view(
            'config.budget-unit.index',
            ['budgetUnits' => $budgetUnits]
        );
    }

    public function create(): View {
        return view('config.budget-unit.create');
    }

    public function store(BudgetUnitRequest $request) {
        $request = $request->all();

        $save = BudgetUnit::create($request);
        if ($save) {
            Alert::success('Unidade Orçamentaria', 'Criada com sucesso');

            return redirect()->route('budget-unit.index');
        }
        Alert::error('Unidade Orçamentaria', 'Erro ao criar');

        return redirect()->back();
    }

    public function details(BudgetUnit $budgetUnit) {
        return view('config.budget-unit.show', ['budgetUnit' => $budgetUnit]);
    }

    public function edit(BudgetUnit $budgetUnit): View {

        return view('config.budget-unit.edit', ['budgetUnit' => $budgetUnit]);
    }

    public function update(BudgetUnit $budgetUnit, BudgetUnitRequest $request) {
        $request = $request->all();

        $update = $budgetUnit->update($request);
        if ($update) {
            Alert::success('Unidade Orçamentaria', 'Atualizado com sucesso');

            return redirect()->route('budget-unit.index');
        }
        Alert::error('Unidade Orçamentaria', 'Erro atualizar');

        return redirect()->back();
    }
}
