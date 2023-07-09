<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingYear extends Model
{
    use HasFactory;
    protected $table = 'accounting_years';
    protected $fillable = [
        'year',
        'expected_budget',
        'budget_plan_id',
        'status',
    ];
}
