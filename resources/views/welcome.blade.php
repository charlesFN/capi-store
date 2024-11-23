<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página Inicial</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        .card-produtos:hover {
            transform: scale(1.025);
        }
    </style>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('components.custom-components.menu')

    @if (!empty($produtos))
        <div class="container mt-3">
            <div class="row d-flex">
                @foreach ($produtos as $produto)
                    <div class="col-3">
                        <a href="{{ route('produto.show', ['id' => $produto->id]) }}" class="text-decoration-none">
                            <div class="card card-produtos">
                                <img src="{{ url($produto->imagem_capa) }}" alt="" class="card-img-top object-fit-contain" style="max-height: 190px">
                                <div class="card-body">
                                    <p class="card-text">{{ $produto->nome_produto }}</p>
                                    <h4 class="card-title">R$ {{ number_format($produto->valor, 2, ',', '.') }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</body>
</html>
