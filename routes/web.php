<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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



Route::get('/', [Controller::class, 'index'])->name('vendas-index');
Route::get('/create', [Controller::class, 'create'])->name('create');
Route::get('/calcularParcelas', [Controller::class, 'calcularParcelas'])->name('calcularParcelas');
Route::post('/store', [Controller::class, 'store'])->name('store');
Route::delete('/{id}', [Controller::class, 'destroy'])->name('destroy');
Route::get('/{id}/edit', [Controller::class, 'edit'])->name('edit');
Route::put('/{id}', [Controller::class, 'update'])->name('update');

    

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [Controller::class, 'index'])->name('dashboard');
});
