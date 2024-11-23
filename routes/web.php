<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ShopCartController;
use App\Http\Controllers\CategoriasController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/visualizar-produto/{id}', [HomeController::class, 'showProduct'])->name('produto.show');
Route::get('/carrinho', [HomeController::class, 'carrinho'])->name('carrinho');

Route::post('/carrinho/adicionar', [ShopCartController::class, 'addCart'])->name('carrinho.adicionar');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::post('/categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/show/{categoria}', [CategoriasController::class, 'show'])->name('categorias.show');
    Route::get('/categorias/edit/{categoria}', [CategoriasController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/update/{categoria}', [CategoriasController::class,'update'])->name('categorias.update');
    Route::delete('/categorias/delete/', [CategoriasController::class, 'destroy'])->name('categorias.delete');

    Route::get('/carrinho/comprar/{id_produto}', [ShopCartController::class, 'comprar'])->name('carrinho.comprar');

    Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/create', [ProdutosController::class, 'create'])->name('produtos.create');
    Route::post('/produtos/store', [ProdutosController::class,'store'])->name('produtos.store');
    Route::get('/produtos/show/{produto}', [ProdutosController::class, 'show'])->name('produtos.show');
    Route::get('/produtos/edit/{produto}', [ProdutosController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/update/{produto}', [ProdutosController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/delete/', [ProdutosController::class, 'destroy'])->name('produtos.delete');
});

require __DIR__.'/auth.php';
