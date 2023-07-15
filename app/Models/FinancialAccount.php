<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialAccount extends Model {
    use HasFactory;

    protected $table = 'financial_accounts';

    protected $fillable = [
        'cod',
        'description',
        'type',
        'status',
    ];
}
