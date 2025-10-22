<?php

namespace App\Services;

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadopagoService
{
    private $access_token;

    public function efetuarPagamento(array $carrinho)
    {
        $itens = [];

        foreach ($carrinho as $produto) {
            $item = [
                'title' => $produto['nome'],
                'quantity' => $produto['quantidade'],
                'unit_price' => $produto['preco']
            ];

            array_push($itens, $item);
        }

        $this->access_token = config('services.mercadopago.access_token_prod');

        MercadoPagoConfig::setAccessToken($this->access_token);

        $client = new PreferenceClient();

        $preference = $client->create([
            "items"=> $itens
        ]);

        $preference->back_urls = array(
            'success' => 'https://capi-store.laravel.cloud/pagamento-aprovado',
            'failure' => 'https://capi-store.laravel.cloud/erro-pagamento',
            'pending' => 'https://capi-store.laravel.cloud/pagamento-pendente'
        );

        $preference->external_reference = auth()->user()->id;

        return $preference;
    }
}
