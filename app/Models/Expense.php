<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table ='expenses';
    
    protected $fillable = [
        'type_expense',
        'description',
        'justification',
        'unit_measurement',
        'amount',
        'installment_value',
        'total_contract_value',
        'hiring_month',
        'renewal_month',
        'previous_residual',
        'margin',
        'renovation',
        'new_installment',
        'current_budget',
        'residual',
        'expense_element_id',
        'project_id',
        'accounting_year_id',
        'budget_unit_id'
    ];

    public function expenseElement()
    {
        return $this->belongsTo(ExpenseElement::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function accountingYear()
    {
        return $this->belongsTo(AccountingYear::class);
    }

    public function budgetUnit()
    {
        return $this->belongsTo(BudgetUnit::class);
    }
}
