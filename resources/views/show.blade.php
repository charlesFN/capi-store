<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $produto->nome_produto }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        .btn-primary {
            background-color: #1E3A8A !important;
        }
        .btn-primary:hover {
            background-color: #0D1A3D !important;
        }
        .btn-primary:active {
            background-color: #1E3A8A !important;
            color: #fff !important;
        }

        .btn-outline-primary {
            border-color: #1E3A8A !important;
            color: #1E3A8A !important;
        }
        .btn-outline-primary:hover {
            background-color: #1E3A8A !important;
            color: #fff !important;
        }
        .btn-outline-primary:active {
            background-color: #1E3A8A !important;
            color: #fff !important;
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
    <div>
        <livewire:components.menu :categorias="$categorias"/>
    </div>

    <div>
        <livewire:home.visualizar-produto :produto="$produto" :valor_venda="$produto->valor" />
    </div>

    @include('components.custom-components.footer')
</body>
</html>
