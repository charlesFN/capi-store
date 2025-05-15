<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Services\MercadoPagoService;

class CarrinhoController extends Controller
{
    private $mercado_pago_service;

    public function __construct(MercadoPagoService $mercadoPagoService)
    {
        $this->mercado_pago_service = $mercadoPagoService;
    }

    public function addCart(Request $request)
    {
        session([
            'id_produto' => $request->id_produto,
            'qtd_produtos' => $request->qtd_produtos
        ]);
    }

    public function comprar($id_produto)
    {
        $produto = Produto::findOrFail($id_produto);

        return view('cart', compact('produto'));
    }

    public function pagamento()
    {
        $carrinho = session()->get('carrinho', []);

        $preferencia = $this->mercado_pago_service->efetuarPagamento($carrinho);

        $total = 0;

        foreach ($carrinho as $produto) {
            $total = $total + ($produto['quantidade'] * $produto['preco']);
        }

        return view('carrinho.pagamento', ['id_preferencia' => $preferencia->id, 'total' => $total]);
    }
}
