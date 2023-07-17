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
        'nature_expense_id',
        'status',
    ];

    public function natureExpense(): BelongsTo {

        return $this->belongsTo(NatureExpense::class, 'nature_expense_id', 'id');

    }
}
