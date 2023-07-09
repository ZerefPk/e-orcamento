<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetUnitController;

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

Route::group(['prefix' => 'unidades-orcamentarias', 'middleware' => ['auth', 'verified']], function (){
    
    Route::get('/',[BudgetUnitController::class, 'show'] )->name('budget-unit.index');
    
    Route::get('/novo',[BudgetUnitController::class, 'create'])->name('budget-unit.create');
    Route::post('/store',[BudgetUnitController::class, 'store'])->name('budget-unit.store');
    
    Route::get('/editar', function () {
        return view('config.budget-unit.create');
    })->name('budget-unit.edit');
    Route::get('{budgetUnit}/detalhes', [BudgetUnitController::class, 'details'])->name('budget-unit.show');
    
});
Route::group(['prefix' => 'projetos', 'middleware' => ['auth', 'verified']], function (){
    Route::get('/', function () {
        return view('config.projects.index');
    })->name('projects.index');
    Route::get('/novo', function () {
        return view('config.projects.create');
    })->name('projects.create');
    Route::get('/editar', function () {
        return view('config.projects.create');
    })->name('projects.edit');
    Route::get('/detalhes', function () {
        return view('config.projects.show');
    })->name('projects.show');
    
});
Route::group(['prefix' => 'contas', 'middleware' => ['auth', 'verified']], function (){
    Route::get('/', function () {
        return view('config.accounts.index');
    })->name('accounts.index');
    Route::get('/novo', function () {
        return view('config.accounts.create');
    })->name('accounts.create');
    Route::get('/editar', function () {
        return view('config.accounts.edit');
    })->name('accounts.edit');
    Route::get('/detalhes', function () {
        return view('config.accounts.show');
    })->name('accounts.show');
    
});
Route::group(['prefix' => 'elementos', 'middleware' => ['auth', 'verified']], function (){
    Route::get('/', function () {
        return view('config.elements.index');
    })->name('elements.index');
    Route::get('/novo', function () {
        return view('config.elements.create');
    })->name('elements.create');
    Route::get('/editar', function () {
        return view('config.elements.edit');
    })->name('elements.edit');
    Route::get('/detalhes', function () {
        return view('config.elements.show');
    })->name('elements.show');
    
});
Route::group(['prefix' => 'planos-orcamentarios', 'middleware' => ['auth', 'verified']], function (){
    Route::get('/', function () {
        return view('config.plans.index');
    })->name('plans.index');
    Route::get('/novo', function () {
        return view('config.plans.create');
    })->name('plans.create');
    Route::get('/editar', function () {
        return view('config.plans.edit');
    })->name('plans.edit');
    Route::get('/detalhes', function () {
        return view('config.plans.show');
    })->name('plans.show');
    
});
require __DIR__.'/auth.php';
