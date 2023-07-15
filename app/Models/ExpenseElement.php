<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseElement extends Model {
    use HasFactory;

    protected $table = 'expense_elements';

    protected $fillable = [
        'cod',
        'description',
        'financial_account_id',
        'status',
    ];

    public function financialAccount(): BelongsTo {

        return $this->belongsTo(FinancialAccount::class, 'financial_account_id', 'id');

    }
}
