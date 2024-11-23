<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $produto->nome_produto }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    {{-- <style>
        .card-produtos:hover {
            transform: scale(1.025);
        }
    </style> --}}

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('components.custom-components.menu')

    <div class="container mt-4">
        <div class="row">
            <div class="col-8">
                @if (!$produto->imagens->isEmpty())
                    <div class="carousel slide" data-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" class="active" data-target="#carouselIndicators" data-slide-to="0" aria-current="true"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ url($produto->imagem_capa) }}" alt="" class="d-block w-100">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-target="carouselIndicators" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visualy-hidden">Anterior</span>
                        </button>
                    </div>
                @else
                    <div class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ url($produto->imagem_capa) }}" alt="" class="carousel-item active">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-4">
                <h3>{{ $produto->nome_produto }}</h3>
                <h2>R$ {{ number_format($produto->valor, 2, ',', '.') }}</h2>
                <div class="row">
                    <div class="col-12">
                        Cor container
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        Tamanho container
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        Compra container
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
