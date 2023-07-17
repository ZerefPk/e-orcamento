<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PredictedUnit extends Model {
    use HasFactory;

    protected $table = 'predicted_units';

    protected $fillable = [
        'budget_unit_id',
        'accounting_year_id',
        'expected_budget',
        'percentage',
        'status',
    ];

    public function unit(): BelongsTo {
        return $this->belongsTo(BudgetUnit::class);
    }
}
