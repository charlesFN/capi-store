<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendasController extends Controller
{
    public function personalizar_produto(Request $request)
    {
        return view('personalizacao.personalizar');
    }
}
