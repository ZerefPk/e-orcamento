<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitProject extends Model
{
    use HasFactory;
    protected $table = 'unit_projects';
    protected $fillable = [
        'budget_unit_id',
        'accounting_year_id',
        'expected_budget',
        'percentage',
        'status',
    ];
}
