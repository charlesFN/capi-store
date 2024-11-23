<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ShopCartController extends Controller
{
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
}
