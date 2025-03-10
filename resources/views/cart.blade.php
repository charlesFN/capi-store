<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrinho</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    {{-- <nav class="navbar navbar-dark bg-dark py-4 border-bottom">
        <div class="container">
            <a href="#" class="navbar-brand">Logo</a>
            <div>
                @if (Auth::check() == true && auth()->user()->is_admin == false)>
                    <a href="#" class="text-decoration-none text-light mx-1" onclick="logout()"><i class="fas fa-power-off"></i> Sair</a>
                @endif
            </div>
        </div>
    </nav> --}}
    <livewire:components.menu-carrinho />

    <div class="container mt-4">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-4">

            </div>
        </div>
    </div>
</body>
</html>
