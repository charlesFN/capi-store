<?php

namespace App\Livewire\Home;

use Livewire\Component;

class VisualizarProduto extends Component
{
    public $produto;

    public $qtd_produto = 1;
    public $valor_produto;
    public $valor_venda;

    public $cor;
    public $medida;

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

    public function render()
    {
        return view('livewire.home.visualizar-produto');
    }
}
