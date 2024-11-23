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

    <livewire:home.visualizar-produto :produto="$produto" :valor_venda="$produto->valor" />
</body>
</html>
