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
    public $valor;
    public $imagem_capa;
    public $informacoes_produto;

    public $cores = 0;

    public $cor;
    public $cores_disponiveis = [];

    public $tamanhos = 0;
    public $medidas = 1;
    public $numeracao = 0;

    public $medidas_disponiveis = [];
    public $numero;

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

    public function adicionarCor()
    {
        $this->validate([
            'cor' => 'string'
        ]);

        $data = [
            'cor' => $this->cor
        ];

        array_push($this->cores_disponiveis, $data);

        $this->cor = null;
    }

    public function removerCor($index)
    {
        array_splice($this->cores_disponiveis, $index, 1);
    }

    public function adicionarNumero()
    {
        $this->validate([
            'numero' => 'string'
        ]);

        $data = [
            'medida' => $this->numero
        ];

        array_push($this->medidas_disponiveis, $data);

        $this->numero = null;
    }

    public function removerNumero($index)
    {
        array_splice($this->medidas_disponiveis, $index, 1);
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

        $this->imagem = null;
    }

    public function removerImagem($index)
    {
        array_splice($this->imagens, $index, 1);
    }

    public function save()
    {
        $this->validate([
            'nome_produto' => 'required|unique:produtos,nome_produto|string|max:50',
            'id_categoria' => 'required|exists:categorias,id',
            'valor' => 'required|numeric',
            'imagem_capa' => ['required', 'file', File::types(['png', 'jpg', 'jpeg', 'jpe', 'webp'])]
        ]);

        $nome_arquivo = $this->imagem_capa->getClientOriginalName();
        $this->imagem_capa->storeAs('public/imagens_produtos', $nome_arquivo);
        $caminho_arquivo = "storage/imagens_produtos/" . $nome_arquivo;

        $data = [
            'nome_produto' => $this->nome_produto,
            'id_categoria' => $this->id_categoria,
            'valor' => $this->valor,
            'imagem_capa' => $caminho_arquivo,
            'informacoes_produto' => $this->informacoes_produto,
            'numeracao' => $this->numeracao
        ];

        $response = $this->produto_service->save($data, $this->cores_disponiveis, $this->medidas_disponiveis, $this->imagens);

        if ($response->status() == '200') {
            session()->flash('success', $response->content());
            return redirect()->route('produtos.index');
        } else {
            session()->flash('error', 'Não foi possível cadastrar o produto.');
            return redirect()->route('produtos.index');
        }
    }
}
