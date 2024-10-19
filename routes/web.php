<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
Route::post('/categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');
Route::get('/categorias/edit/{categoria}', [CategoriasController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/update', [CategoriasController::class,'update'])->name('categorias.update');
Route::delete('/categorias/delete/', [CategoriasController::class, 'destroy'])->name('categorias.delete');

require __DIR__.'/auth.php';
