<?php

namespace App\Livewire\Home;

use Livewire\Component;

class VisualizarProduto extends Component
{
    public $produto;

    public $qtd_produto = 1;
    public $valor_produto;
    public $valor_venda;

    public $cor = null;
    public $medida = null;

    /* public $id_produto_adicionado; */
    /* public $qtd_produto_adicionado; */
    /* public $cor_adicionada; */
    /* public $medida_adicionada; */

    public function addProduto()
    {
        $this->qtd_produto++;

        $this->valor_venda = $this->produto->valor * $this->qtd_produto;
    }

    public function rmvProduto()
    {
        $this->qtd_produto--;

        $this->valor_venda = $this->produto->valor * $this->qtd_produto;
    }

    public function adicionarAoCarrinho()
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$this->produto->id])) {
            $carrinho[$this->produto->id]['quantidade'] += $this->qtd_produto;
        } else {
            $carrinho[$this->produto->id] = [
                'nome' => $this->produto->nome_produto,
                'preco' => $this->produto->valor,
                'quantidade' => $this->qtd_produto,
                'imagem' => $this->produto->imagem_capa
            ];
        }

        session()->put('carrinho', $carrinho);

        $this->reset('qtd_produto', 'valor_venda');
        session()->flash('success', 'Produto adicionado ao carrinho');

        return response()->json(['success', 'carrinho' => $carrinho]);
    }

    public function render()
    {
        return view('livewire.home.visualizar-produto');
    }
}
