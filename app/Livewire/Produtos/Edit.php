<?php

namespace App\Livewire\Produtos;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\ProdutoService;
use Illuminate\Validation\Rules\File;

class Edit extends Component
{
    use WithFileUploads;

    public $categorias;
    public $produto;


    public $nome_produto;
    public $id_categoria;
    public $valor;


    public $imagem_capa;
    public $nova_imagem_capa = null;


    public $informacoes_produto = null;


    public $cores;
    public $cor;
    public $cores_disponiveis = [];


    public $tamanhos;
    public $medidas;
    public $medidas_disponiveis = [];


    public $tabela_medidas;
    public $nova_tabela_medidas = null;


    public $numero;
    public $numeros_disponiveis = [];


    public $numeracao;
    public $nome_cliente;



    public $imagem;
    public $imagens = [];



    protected $produto_service;

    public function boot(ProdutoService $produtoService)
    {
        $this->produto_service = $produtoService;
    }

    public function mount()
    {
        $this->nome_produto = $this->produto->nome_produto;
        $this->valor = $this->produto->valor;
        $this->id_categoria = $this->produto->id_categoria;
        $this->imagem_capa = $this->produto->imagem_capa;
        $this->tabela_medidas = $this->produto->tabela_medidas;
        $this->numeracao = $this->produto->numeracao;
        $this->nome_cliente = $this->produto->nome_cliente;

        if (!empty($this->produto->informacoes_produto)) {
            $this->informacoes_produto = $this->produto->informacoes_produto;
        }

        $qtd_cores = count($this->produto->cores);
        if ($qtd_cores > 0) {
            $this->cores = 1;

            foreach ($this->produto->cores as $cor) {
                $data = [
                    'id' => $cor->id,
                    'cor' => $cor->cor,
                    'salvar' => null
                ];

                array_push($this->cores_disponiveis, $data);
            }
        } else {
            $this->cores = 0;
        }

        $qtd_tamanhos = count($this->produto->tamanhos);

        if ($qtd_tamanhos > 0) {
            $this->tamanhos = 1;

            if ($this->produto->tipo_tamanho == 1) {
                $this->medidas = 1;

                foreach ($this->produto->tamanhos as $tamanho) {
                    array_push($this->medidas_disponiveis, $tamanho->medida);
                }
            } else {
                $this->medidas = 2;

                foreach ($this->produto->tamanhos as $tamanho) {
                    $data = [
                        "medida" => $tamanho->medida
                    ];

                    array_push($this->numeros_disponiveis, $data);
                }
            }
        } else {
            $this->tamanhos = 0;
        }

        if ($this->produto->numeracao == 0) {
            $this->numeracao = 0;
        } else {
            $this->numeracao = 1;
        }

        $qtd_imagens = count($this->produto->imagens);
        if ($qtd_imagens > 0) {
            foreach ($this->produto->imagens as $imagem) {
                $data = [
                    'id' => $imagem->id,
                    'caminho_arquivo' => $imagem->url_imagem,
                    "salvar" => null
                ];

                array_push($this->imagens, $data);
            }
        }
    }

    public function adicionarCor()
    {
        $this->validate([
            'cor' => 'required'
        ]);

        $data = [
            'id' => 0,
            'cor' => $this->cor,
            'salvar' => "sim"
        ];

        array_push($this->cores_disponiveis, $data);

        $this->cor = null;
    }

    public function removerCor($index, $id_cor)
    {
        if ($id_cor != 0) {
            $this->cores_disponiveis[$index]['salvar'] = "nao";
        } else {
            array_splice($this->cores_disponiveis, $index, 1);
        }
    }

    public function adicionarNumero()
    {
        $this->validate([
            'numero' => 'required'
        ]);

        $data = [
            'medida' => $this->numero,
        ];

        array_push($this->numeros_disponiveis, $data);

        $this->numero = null;
    }

    public function removerNumero($index)
    {
        array_splice($this->numeros_disponiveis, $index, 1);
    }

    public function adicionarImagem()
    {
        $this->validate([
            'imagem' => ['required', 'file', File::types(['png', 'jpg', 'jpeg', 'jpe', 'webp'])]
        ]);

        $nome_arquivo = $this->imagem->getClientOriginalName();
        $this->imagem->storeAs('public/imagens_produtos', $nome_arquivo);
        $caminho_arquivo = "storage/imagens_produtos/" . $nome_arquivo;

        $data = [
            'id' => 0,
            'caminho_arquivo' => $caminho_arquivo,
            'salvar'=> "sim"
        ];

        array_push($this->imagens, $data);

        $this->imagem = null;
    }

    public function removerImagem($index, $id_imagem)
    {
        if ($id_imagem != 0) {
            $this->imagens[$index]['salvar'] = "nao";
        } else {
            array_splice($this->imagens, $index, 1);
        }
    }

    public function save()
    {
        $this->validate([
            'nome_produto' => "required|string|max:50",
            'id_categoria' => 'required|exists:categorias,id',
            'valor' => 'required|numeric',
            'numeracao' => 'required',
            'nome_cliente' => 'required',
        ]);

        if ($this->nova_imagem_capa == null) {
            $data = [
                'nome_produto' => $this->nome_produto,
                'id_categoria' => $this->id_categoria,
                'imagem_capa' => $this->imagem_capa,
                'informacoes_produto' => $this->informacoes_produto,
                'valor' => $this->valor,
                'numeracao' => $this->numeracao,
                'nome_cliente' => $this->nome_cliente,
                'tipo_tamanho' => $this->medidas,
                'tabela_medidas' => null
            ];
        } else {
            $this->validate([
                'nova_imagem_capa' => ['file', File::types(['png', 'jpg', 'jpeg', 'jpe', 'webp'])]
            ]);

            $nome_arquivo = $this->nova_imagem_capa->getClientOriginalName();
            $this->nova_imagem_capa->storeAs('public/imagens_produtos', $nome_arquivo);
            $caminho_arquivo = "storage/imagens_produtos/" . $nome_arquivo;

            $data = [
                'nome_produto' => $this->nome_produto,
                'id_categoria' => $this->id_categoria,
                'imagem_capa' => $caminho_arquivo,
                'informacoes_produto' => $this->informacoes_produto,
                'valor' => $this->valor,
                'numeracao' => $this->numeracao,
                'nome_cliente' => $this->nome_cliente,
                'tipo_tamanho' => $this->medidas,
                'tabela_medidas' => null
            ];
        }

        if ($this->cores == 0) {
            $this->cores_disponiveis = null;
        }

        if ($this->tamanhos == 1) {
            if ($this->medidas == 1) {
                $this->numeros_disponiveis = null;

                if ($this->nova_tabela_medidas == null) {
                    $data['tabela_medidas'] = $this->tabela_medidas;
                } else {
                    $this->validate([
                        'nova_tabela_medidas' => ['file', File::types(['png', 'jpg', 'jpeg', 'jpe', 'webp'])]
                    ]);

                    $nome_arquivo = $this->nova_tabela_medidas->getClientOriginalName();
                    $this->nova_tabela_medidas->storeAs('public/imagens_produtos', $nome_arquivo);
                    $caminho_arquivo = "storage/imagens_produtos/" . $nome_arquivo;

                    $data['tabela_medidas'] = $caminho_arquivo;
                }
            } elseif ($this->medidas == 2) {
                $this->medidas_disponiveis = null;

                $data['tabela_medidas'] = null;
            }
        } elseif ($this->tamanhos == 0) {
            $this->medidas_disponiveis = null;
            $this->numeros_disponiveis = null;

            $data['tabela_medidas'] = null;
        }

        $response = $this->produto_service->update($data, $this->cores_disponiveis, $this->medidas_disponiveis, $this->numeros_disponiveis, $this->imagens, $this->produto);

        if ($response->status() == '200') {
            session()->flash('success', $response->content());
            return redirect()->route('produtos.index');
        } else {
            session()->flash('error', 'Não foi possível atualizar o produto.');
            return redirect()->route('produtos.index');
        }
    }

    public function render()
    {
        return view('livewire.produtos.edit');
    }
}
