<?php

namespace App\Livewire\Produtos;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Services\ProdutoService;
use Illuminate\Validation\Rules\File;

class Create extends Component
{
    use WithFileUploads;

    public $categorias;

    public $nome_produto;
    public $id_categoria;
    public $genero;
    public $valor;

    public $imagem;
    public $imagens = [];

    protected $produto_service;

    public function boot(ProdutoService $produtoService)
    {
        $this->produto_service = $produtoService;
    }

    public function render()
    {
        return view('livewire.produtos.create');
    }

    public function adicionarImagem()
    {
        $this->validate([
            'imagem' => ['file', File::types(['png', 'jpg', 'jpeg', 'jpe', 'webp'])]
        ]);

        $nome_arquivo = $this->imagem->getClientOriginalName();
        $this->imagem->storeAs('public/imagens_produtos', $nome_arquivo);
        $caminho_arquivo = "storage/imagens_produtos/" . $nome_arquivo;

        $data = [
            'nome_arquivo' => $nome_arquivo,
            'caminho_arquivo' => $caminho_arquivo
        ];

        array_push($this->imagens, $data);
    }

    public function save()
    {
        $data = $this->validate([
            'nome_produto' => 'required|unique:produtos,nome_produto|string|max:50',
            'id_categoria' => 'required|exists:categorias,id',
            'genero' => 'required|in:Nenhum,Feminino,Masculino,Unissex',
            'valor' => 'required|numeric'
        ]);

        $response = $this->produto_service->save($data, $this->imagens);

        if ($response->status() == '200') {
            session()->flash('success', $response->content());
            return redirect()->route('produtos.index');
        } else {
            session()->flash('error', 'Não foi possível cadastrar o produto.');
            return redirect()->route('produtos.index');
        }
    }
}
