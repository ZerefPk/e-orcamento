<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Contracts\View\View;

class ExpenseController extends Controller {
    public function show(): View {

        if (request('q')) {
            $data = request('q');
            $expenses = Expense::where('acronym', 'like', $data.'%');
            $expenses = $expenses->paginate(15);
        } else {
            $expenses = Expense::paginate(15);
        }

        return view(
            'budget-unit.index',
            ['expenses' => $expenses]
        );

        return view('budget.index');
    }
}
