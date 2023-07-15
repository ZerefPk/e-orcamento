<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class BudgetUnit extends Model {
    use HasFactory;

    protected $table = 'budget_units';

    protected $fillable = [
        'acronym',
        'description',
        'status',
    ];

    public function projects(): hasMany {

        return $this->hasMany(Project::class);

    }
}
