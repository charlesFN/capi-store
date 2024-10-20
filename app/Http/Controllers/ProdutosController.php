<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\ProdutoService;

class ProdutosController extends Controller
{
    protected $produto_service;

    public function __construct(ProdutoService $produtoService)
    {
        $this->produto_service = $produtoService;
    }

    public function index()
    {
        $produtos = Produto::orderBy('id', 'desc')->paginate(10);

        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome_categoria', 'ASC')->get(['id', 'nome_categoria']);

        return view('produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome_produto' => 'required|unique:produtos,nome_produto|string|max:50',
            'id_categoria' => 'required|exists:categorias,id',
            'genero' => 'required|in:Nenhum,Feminino,Masculino,Unissex',
            'valor' => 'required|numeric'
        ]);

        $response = $this->produto_service->save($data);

        if ($response->status() == '200') {
            return redirect()->route('produtos.index')->with('success', $response->content());
        } else {
            return redirect()->route('produtos.index')->with('error', 'Não foi possível cadastrar o produto.');
        }
    }

    public function show(Produto $produto)
    {
        //
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::orderBy('nome_categoria')->get(['id', 'nome_categoria']);

        return view('produtos.edit', [
            'produto' => $produto,
            'categorias' => $categorias
        ]);
    }

    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'nome_produto' => ['required', Rule::unique('produtos')->ignore($produto->id), 'string', 'max:50'],
            'id_categoria' => 'required|exists:categorias,id',
            'genero' => 'required|in:Nenhum,Feminino,Masculino,Unissex',
            'valor' => 'required|numeric'
        ]);

        $response = $this->produto_service->update($data, $produto);

        if ($response->status() == 200) {
            return redirect()->route('produtos.index')->with('success',$response->content());
        }
        else {
            return redirect()->route('produtos.index')->with('error', 'Não foi possível atualizar o produto.');
        }
    }

    public function destroy(Produto $produto)
    {
        $response = $this->produto_service->delete($produto);

        if ($response->status() == 200) {
            return redirect()->route('produtos.index')->with('success',$response->content());
        } else {
            return redirect()->route('produtos.index')->with('error', 'Não foi possível deletar o produto.');
        }
    }
}
