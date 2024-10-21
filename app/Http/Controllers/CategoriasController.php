<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\CategoriaService;

class CategoriasController extends Controller
{
    protected $categoria_service;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoria_service = $categoriaService;
    }

    public function index()
    {
        $categorias = Categoria::orderBy("id","desc")->paginate(10);

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome_categoria' => 'required|unique:categorias,nome_categoria|string|max:50'
        ]);

        $response = $this->categoria_service->save($data);

        if ($response->status() == 200) {
            session()->flash('success', $response->content());
            return redirect()->route('categorias.index');
        } else {
            session()->flash('error', 'Não foi possível criar a categoria.');
            return redirect()->route('categorias.index');
        }
    }

    public function show(Categoria $categoria)
    {
        $produtos = $categoria->produtos;

        return view('categorias.show', [
            'categoria' => $categoria,
            'produtos' => $produtos
        ]);
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nome_categoria' => ['required', Rule::unique('categorias')->ignore($categoria->id), 'string','max:50']
        ]);

        $response = $this->categoria_service->update($data, $categoria);

        if ($response->status() == 200) {
            session()->flash('success', $response->content());
            return redirect()->route('categorias.index');
        }
        else {
            session()->flash('error', 'Não foi possível atualizar a categoria.');
            return redirect()->route('categorias.index');
        }
    }

    public function destroy(Categoria $categoria)
    {
        $response = $this->categoria_service->delete($categoria);

        if ($response->status() == 200) {
            session()->flash('success', $response->content());
            return redirect()->route('categorias.index');
        } else {
            session()->flash('error', 'Não foi possível deletar a categoria.');
            return redirect()->route('categorias.index');
        }
    }
}
