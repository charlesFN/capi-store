<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CapiStore - Pagamento</title>

    <script src="https://sdk.mercadopago.com/js/v2"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg border-bottom" style="background-color: #F59E0B">
        <div class="container-fluid">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('img/logo-site.png') }}" alt="" width="90" height="90">
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div>
                    Produtos
                    <ul>
                        @foreach (session('carrinho') as $produto)
                            <li>{{ $produto['quantidade'] }}x {{ $produto['nome'] }} R${{ number_format($produto['preco'], 2, ',', '') }}</li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    Total R${{ number_format($total, 2, ',', '') }}
                </div>

                <div id="wallet_container"></div>
            </div>
        </div>
    </div>

    <script>
        const mp = new MercadoPago('APP_USR-0ab9d3ce-2b8d-42b9-9c4c-b7e9cbe64adc');

        mp.bricks().create("wallet", "wallet_container", {
            initialization: {
                preferenceId: `{{ $id_preferencia }}`
            }
        })
    </script>
</body>
</html>
