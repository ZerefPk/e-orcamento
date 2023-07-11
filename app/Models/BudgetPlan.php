<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class BudgetPlan extends Model
{
    use HasFactory;
    protected $table = 'budget_plans';
    protected $fillable = [
        'name',
        'beginning_term',
        'end_period',
        'status',
    ];

    public function accountingYears() : hasMany {
        
        return $this->hasMany(AccountingYear::class);

    }
}
