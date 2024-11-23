<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nome_categoria', 'asc')->limit(5)->get();
        $produtos = Produto::orderBy('nome_produto', 'asc')->get();

        return view("welcome", [
            "categorias"=> $categorias,
            "produtos"=> $produtos
        ]);
    }

    public function showProduct($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::orderBy('nome_categoria', 'asc')->limit(5)->get();

        return view('show', [
            "produto" => $produto,
            "categorias" => $categorias
        ]);
    }
}
