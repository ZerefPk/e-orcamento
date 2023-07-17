<?php

use App\Http\Controllers\BudgetPlanController;
use App\Http\Controllers\BudgetUnitController;
use App\Http\Controllers\ExpenseElementController;
use App\Http\Controllers\NatureExpenseController;
use App\Http\Controllers\PredictedUnitController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'unidades-orcamentarias', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [BudgetUnitController::class, 'show'])->name('budget-unit.index');

    Route::get('/novo', [BudgetUnitController::class, 'create'])->name('budget-unit.create');
    Route::post('/store', [BudgetUnitController::class, 'store'])->name('budget-unit.store');

    Route::get('{budgetUnit}/editar', [BudgetUnitController::class, 'edit'])->name('budget-unit.edit');
    Route::post('{budgetUnit}/update', [BudgetUnitController::class, 'update'])->name('budget-unit.update');

    Route::get('{budgetUnit}/detalhes', [BudgetUnitController::class, 'details'])->name('budget-unit.show');
});

Route::group(['prefix' => 'projetos', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [ProjectController::class, 'show'])->name('projects.index');

    Route::get('/novo', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/store', [ProjectController::class, 'store'])->name('projects.store');

    Route::get('{project}/editar', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('{project}/update', [ProjectController::class, 'update'])->name('projects.update');

    Route::get('{project}/detalhes', [ProjectController::class, 'details'])->name('projects.show');
});

Route::group(['prefix' => 'naturezas-das-despesas', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [NatureExpenseController::class, 'show'])->name('natureExpense.index');

    Route::get('/novo', [NatureExpenseController::class, 'create'])->name('natureExpense.create');
    Route::post('/store', [NatureExpenseController::class, 'store'])->name('natureExpense.store');

    Route::get('{natureExpense}/editar', [NatureExpenseController::class, 'edit'])->name('natureExpense.edit');
    Route::post('{natureExpense}/update', [NatureExpenseController::class, 'update'])->name('natureExpense.update');

    Route::get('{natureExpense}/detalhes', [NatureExpenseController::class, 'details'])->name('natureExpense.show');
});

Route::group(['prefix' => 'elementos', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [ExpenseElementController::class, 'show'])->name('elements.index');

    Route::get('/novo', [ExpenseElementController::class, 'create'])->name('elements.create');
    Route::post('/store', [ExpenseElementController::class, 'store'])->name('elements.store');

    Route::get('{expenseElement}/editar', [ExpenseElementController::class, 'edit'])->name('elements.edit');
    Route::post('{expenseElement}/update', [ExpenseElementController::class, 'update'])->name('elements.update');

    Route::get('{expenseElement}/detalhes', [ExpenseElementController::class, 'details'])->name('elements.show');
});

Route::group(['prefix' => 'planos-orcamentarios', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [BudgetPlanController::class, 'show'])->name('plans.index');

    Route::get('/novo', [BudgetPlanController::class, 'create'])->name('plans.create');
    Route::post('/store', [BudgetPlanController::class, 'store'])->name('plans.store');

    Route::get('{budgetPlan}/editar', [BudgetPlanController::class, 'edit'])->name('plans.edit');
    Route::post('{budgetPlan}/update', [BudgetPlanController::class, 'update'])->name('plans.update');

    Route::get('{budgetPlan}/anos-contabeis', [BudgetPlanController::class, 'editAccountingYears'])->name('plans.editAccountingYears');
    Route::post('{budgetPlan}/update-accounting-years', [BudgetPlanController::class, 'updateAccountingYears'])->name('plans.updateAccountingYears');

    Route::get('{budgetPlan}/detalhes', [BudgetPlanController::class, 'details'])->name('plans.show');

    Route::group(['prefix' => '{budgetPlan}/unidade-do-orcamento'], function(){
        Route::get('/', [PredictedUnitController::class, 'show'])->name('plans.unit.index');
        Route::get('/novo', [PredictedUnitController::class, 'create'])->name('plans.unit.create');
        Route::post('/store', [PredictedUnitController::class, 'store'])->name('plans.unit.store');
    });
});


require __DIR__.'/auth.php';
