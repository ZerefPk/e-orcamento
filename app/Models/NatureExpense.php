<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatureExpense extends Model {
    use HasFactory;

    protected $table = 'nature_expenses';

    protected $fillable = [
        'cod',
        'description',
        'type',
        'status',
    ];
}
