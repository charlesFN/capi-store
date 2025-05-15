<!DOCTYPE html>
<html lang="pt-BR">
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

        .floating-card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }
        .floating-card:hover {
            transform: translate(-50%, -50%) scale(1.05);
        }

        /* Estilo do card flutuante */
        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
           /*  display: none; */
            max-height: 200px;
            overflow-y: auto;
            z-index: 1050;
        }
    </style>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body style="background-color: #F3F4F6">
    <livewire:components.menu :categorias="$categorias"/>

    @if (!empty($produtos))
    <div class="container mt-3">
        <div class="row">
            <h4 style="color: #F59E0B">Produtos</h4>
        </div>
        <hr class="mb-4" style="color: #1E3A8A">
        <div class="row">
            @foreach ($produtos as $produto)
                <div class="col-3">
                    <a href="{{ route('produto.show', ['id' => $produto->id]) }}" class="text-decoration-none">
                        <div class="card card-produtos" style="background-color: #F3F4F6">
                            <img src="{{ url($produto->imagem_capa) }}" alt="" class="card-img-top object-fit-contain" style="max-height: 190px">
                            <div class="card-body">
                                <p class="card-text fw-bold" style="color: #1E3A8A">{{ $produto->nome_produto }}</p>
                                <h4 class="card-title" style="color: #F59E0B">R$ {{ number_format($produto->valor, 2, ',', '.') }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    @include('components.custom-components.footer')
</body>
</html>
