<?php

namespace App\Observers;

use App\Models\AccountingYear;
use App\Models\BudgetPlan;

class BudgetPlanObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;
    /**
     * Handle the BudgetPlan "created" event.
     */
    public function created(BudgetPlan $budgetPlan): void
    {
        //
        $i= intval(date('Y', strtotime($budgetPlan->beginning_term)));
        $end= intval(date('Y', strtotime($budgetPlan->end_period)))+1;
       
        for ($i; $i < $end; $i++) { 
            AccountingYear::create([
                'year' => $i,
                'expected_budget' => 0.00,
                'budget_plan_id'=> $budgetPlan->id,
                'status' => 1,
            ]);
        }
        
    }

    /**
     * Handle the BudgetPlan "updated" event.
     */
    public function updated(BudgetPlan $budgetPlan): void
    {
        //
        $i= intval(date('Y', strtotime($budgetPlan->beginning_term)));
        $end= intval(date('Y', strtotime($budgetPlan->end_period)))+1;
       
        
        for ($i; $i < $end; $i++) { 
            
            $accountingYear = AccountingYear::where('year', $i)->where('budget_plan_id', $budgetPlan->id)->first();
            if(is_null($accountingYear)){
                
                AccountingYear::create([
                    'year' => $i,
                    'expected_budget' => 0.00,
                    'budget_plan_id'=> $budgetPlan->id,
                    'status' => 1,
                ]);
            }
            
            
        }
        

    }

    /**
     * Handle the BudgetPlan "deleted" event.
     */
    public function deleted(BudgetPlan $budgetPlan): void
    {
        //
    }

    /**
     * Handle the BudgetPlan "restored" event.
     */
    public function restored(BudgetPlan $budgetPlan): void
    {
        //
    }

    /**
     * Handle the BudgetPlan "force deleted" event.
     */
    public function forceDeleted(BudgetPlan $budgetPlan): void
    {
        //
    }
}
