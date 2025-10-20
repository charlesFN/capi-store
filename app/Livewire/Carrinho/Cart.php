<?php

namespace App\Livewire\Carrinho;

use Livewire\Component;

class Cart extends Component
{
    public $personalizavel;

    public function mount()
    {
        $qtd_personalizavel = 0;

        foreach (session()->get('carrinho', []) as $key => $produto) {
            if ($produto['numeracao'] == true || $produto['nome_cliente'] == true) {
                $qtd_personalizavel++;
            }
        }

        if ($qtd_personalizavel > 0) {
            $this->personalizavel = true;
        } else {
            $this->personalizavel = false;
        }
    }

    public function subtrairProduto($id_produto)
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id_produto])) {
            $carrinho[$id_produto]['quantidade'] = $carrinho[$id_produto]['quantidade'] - 1;

            session()->put('carrinho', $carrinho);
        }
    }

    public function adicionarProduto($id_produto)
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($id_produto)) {
            $carrinho[$id_produto]['quantidade'] = $carrinho[$id_produto]['quantidade'] + 1;
        }

        session()->put('carrinho', $carrinho);
    }

    public function removerProduto($id_produto)
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id_produto])) {
            unset($carrinho[$id_produto]);

            session()->put('carrinho', $carrinho);
        }
    }

    /* public function comprar()
    {
        if (auth()->user() == null) {
            return redirect()->route('login');
        }
    }
 */
    public function render()
    {
        return view('livewire.carrinho.cart');
    }
}
