<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NatureExpense extends Model {
    use HasFactory;

    protected $table = 'nature_expenses';

    protected $fillable = [
        'cod',
        'description',
        'type',
        'status',
    ];

    public function elements(): HasMany {
        return $this->hasMany(ExpenseElement::class);
    }
}
