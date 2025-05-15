<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function status_pagamento(Request $request)
    {
        dd($request);
    }

    public function pagamento_aprovado()
    {
        return view('back-urls.success');
    }

    public function pagamento_pendente()
    {
        return view('back-urls.pending');
    }

    public function erro_pagamento()
    {
        return view('back-urls.failure');
    }
}
