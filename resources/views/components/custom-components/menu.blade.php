<nav class="navbar border-bottom" style="background-color: #F59E0B">
    <div class="container">
        <a href="#" class="navbar-brand">
            <img src="{{ asset('img/logo-site.png') }}" alt="" width="90" height="90">
        </a>
        <form class="d-flex w-50">
            <input class="form-control" type="search" placeholder="O que você procura?" aria-label="Pesquisar">
        </form>
        <div>
            @if (Auth::check() == true && auth()->user()->is_admin == true)
                <a href="{{ route('categorias.index') }}" class="text-decoration-none text-light mx-1">Dashboard</a>
                <span class="text-light mx-1">|</span>
                <a href="#" class="text-decoration-none text-light mx-1" onclick="logout()"><i class="fas fa-power-off"></i> Sair</a>
            @elseif (Auth::check() == true && auth()->user()->is_admin == false)
                <a href="#" class="text-decoration-none text-light mx-1"><i class="fas fa-cart-shopping"></i></a>
                <span class="text-light mx-1">|</span>
                <a href="#" class="text-decoration-none text-light mx-1" onclick="logout()"><i class="fas fa-power-off"></i> Sair</a>
            @elseif (Auth::check() == false)
                <a href="{{ route('login') }}" class="text-decoration-none text-light mx-1">Entre</a> <span class="text-light">ou</span> <a href="{{ route('register') }}" class="text-decoration-none text-light mx-1">Cadastre-se</a>
            @endif
        </div>
    </div>
</nav>
@php
    $numero_categorias = count($categorias);
@endphp
@if ($numero_categorias > 0)
    <nav class="navbar" style="background-color: #F3F4F6">
        <div class="container">
            <div>
                @foreach ($categorias as $categoria)
                    <a href="" class="text-decoration-none mx-2 fw-bold" style="color: #1E3A8A">{{ $categoria->nome_categoria }}</a>
                @endforeach
            </div>
            @if($numero_categorias > 5)
                <a href="#" class="text-decoration-none fw-bold" style="color: #1E3A8A">Mais categorias...</a>
            @endif
        </div>
    </nav>
@endif

<form action="{{ route('logout') }}" method="post" id="formLogout">
    @csrf
</form>

<script>
    function logout() {
        $("#formLogout").submit();
    }
</script>
