<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredictedUnit extends Model
{
    use HasFactory;
    protected $table = 'predicted_units';
    protected $fillable = [
        'budget_unit_id',
        'accounting_year_id',
        'expected_budget',
        'percentage',
        'status',
    ];
}
