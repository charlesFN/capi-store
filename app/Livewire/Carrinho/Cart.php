<?php

namespace App\Livewire\Carrinho;

use App\Services\MercadoPagoService;
use Livewire\Component;

class Cart extends Component
{
    private $mercado_pago_service;

    public function boot(MercadoPagoService $mercadoPagoService)
    {
        $this->mercado_pago_service = $mercadoPagoService;
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

    public function comprar()
    {
        if (auth()->user() == null) {
            return redirect()->route('login');
        }

        $carrinho = session()->get('carrinho', []);

        $this->mercado_pago_service->efetuarPagamento($carrinho);
    }

    public function render()
    {
        return view('livewire.carrinho.cart');
    }
}
