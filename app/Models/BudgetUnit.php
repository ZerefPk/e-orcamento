<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetUnit extends Model
{
    use HasFactory;
    protected $table = 'budget_units';
    protected $fillable = [
        'acronym',
        'description',
        'status',
    ];
}
