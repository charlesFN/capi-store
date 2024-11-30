<?php

namespace App\Livewire\Produtos;

use Livewire\Component;
use Illuminate\Validation\Rules\File;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $categorias;
    public $produto;


    public $nome_produto;
    public $id_categoria;
    public $valor;


    public $nova_imagem_capa;


    public $informacoes_produto;


    public $cores;
    public $cor;
    public $cores_disponiveis = [];


    public $tamanhos;
    public $medidas;
    public $medidas_disponiveis = [];



    public $numero;
    public $numeros_disponiveis = [];


    public $numeracao;



    public $imagem;
    public $imagens = [];


    public function mount()
    {
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
                        "id" => $tamanho->id,
                        "medida" => $tamanho->medida,
                        "salvar" => null
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
            'salvar' => true
        ];

        array_push($this->cores_disponiveis, $data);

        $this->cor = null;
    }

    public function removerCor($index, $id_cor)
    {
        if ($id_cor != 0) {
            $this->cores_disponiveis[$index]['salvar'] = false;
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
            'id' => 0,
            'medida' => $this->numero,
            'salvar' => true
        ];

        array_push($this->numeros_disponiveis, $data);

        $this->numero = null;
    }

    public function removerNumero($index, $id_numero)
    {
        if ($id_numero != 0) {
            $this->numeros_disponiveis[$index]['salvar'] = false;
        } else {
            array_splice($this->numeros_disponiveis, $index, 1);
        }
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
            'salvar'=> true
        ];

        array_push($this->imagens, $data);

        $this->imagem = null;
    }

    public function removerImagem($index, $id_imagem)
    {
        if ($id_imagem != 0) {
            $this->numeros_disponiveis[$index]['salvar'] = false;
        } else {
            array_splice($this->imagens, $index, 1);
        }
    }

    public function render()
    {
        return view('livewire.produtos.edit');
    }
}
