<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
