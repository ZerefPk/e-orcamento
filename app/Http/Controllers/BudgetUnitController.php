<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\BudgetUnitRequest;
use App\Models\BudgetUnit;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;


class BudgetUnitController extends Controller
{
    //
    
    function show() : View {

        if(request('q'))
        {
            $data = request('q');
            $budgetUnits = BudgetUnit::where('acronym', 'like', $data.'%');
            $budgetUnits = $budgetUnits->paginate(15);
        }
        else{
            $budgetUnits = BudgetUnit::paginate(15);
        }

      
        return view(
            'config.budget-unit.index',
            ['budgetUnits' => $budgetUnits]
        );
    }
    
    function create() : View {
        return view('config.budget-unit.create');
    }

    function store(BudgetUnitRequest $request) {
        $request = $request->all();

        $save = BudgetUnit::create($request);
        if($save){
            Alert::success('Unidade Orçamentaria', 'Criada com sucesso');
            return redirect()->route('budget-unit.index');
        }
        Alert::error('Unidade Orçamentaria', 'Erro ao criar');
        return redirect()->back();
        
    }
    public function details( BudgetUnit $budgetUnit) : View {

        return view( 'config.budget-unit.show', ['budgetUnit' => $budgetUnit] );
    }
}
