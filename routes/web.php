<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModalidadesController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\VendasController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/visualizar-produto/{id}', [HomeController::class, 'showProduct'])->name('produto.show');
Route::get('/carrinho', [HomeController::class, 'carrinho'])->name('carrinho');

/* Route::post('/carrinho/adicionar', [ShopCartController::class, 'addCart'])->name('carrinho.adicionar'); */

Route::post('/webhook/status-pagamento', [WebhookController::class, 'status_pagamento'])->name('webhooks.status_pagamento');

Route::get('/pagamento-aprovado', [WebhookController::class, 'pagamento_aprovado'])->name('vendas.pagamento_aprovado');
Route::get('/pagamento-pendente', [WebhookController::class, 'pagamento_pendente'])->name('vendas.pagamento_pendente');
Route::get('/erro-pagamento', [WebhookController::class, 'erro_pagamento'])->name('vendas.erro_pagamento');

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

    /* Route::get('/carrinho/comprar/{id_produto}', [CarrinhoController::class, 'comprar'])->name('carrinho.comprar'); */

    Route::get('/carrinho/pagamento', [CarrinhoController::class, 'pagamento'])->name('carrinho.pagamento');

    Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/create', [ProdutosController::class, 'create'])->name('produtos.create');
    Route::post('/produtos/store', [ProdutosController::class,'store'])->name('produtos.store');
    Route::get('/produtos/show/{produto}', [ProdutosController::class, 'show'])->name('produtos.show');
    Route::get('/produtos/edit/{produto}', [ProdutosController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/update/{produto}', [ProdutosController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/delete/', [ProdutosController::class, 'destroy'])->name('produtos.delete');

    Route::get('/modalidades', [ModalidadesController::class, 'index'])->name('modalidades.index');
    Route::get('/modalidades/create', [ModalidadesController::class, 'create'])->name('modalidades.create');
    Route::post('/modalidades/store', [ModalidadesController::class,'store'])->name('modalidades.store');
    Route::get('/modalidades/show/{modalidade}', [ModalidadesController::class, 'show'])->name('modalidades.show');
    Route::get('/modalidades/edit/{modalidade}', [ModalidadesController::class, 'edit'])->name('modalidades.edit');
    Route::put('/modalidades/update/{modalidade}', [ModalidadesController::class, 'update'])->name('modalidades.update');
    Route::delete('/modalidades/delete/', [ModalidadesController::class, 'destroy'])->name('modalidades.delete');

    Route::get('/personalizar-produto', [VendasController::class, 'personalizar_produto'])->name('vendas.personalizar_produto');
});

require __DIR__.'/auth.php';
