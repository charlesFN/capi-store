<nav class="navbar navbar-dark bg-dark py-4 border-bottom">
    <div class="container">
        <a href="#" class="navbar-brand">Logo</a>
        <form class="d-flex w-50">
            <input class="form-control" type="search" placeholder="Pesquisar produto" aria-label="Pesquisar">
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
                <a href="{{ route('login') }}" class="text-decoration-none text-light mx-1">Entrar</a>
                <span class="text-light mx-1">|</span>
                <a href="{{ route('register') }}" class="text-decoration-none text-light mx-1">Cadastrar-se</a>
            @endif
        </div>
    </div>
</nav>
@php
    $numero_categorias = count($categorias);
@endphp
@if ($numero_categorias > 0)
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <div>
                @foreach ($categorias as $categoria)
                    <a href="" class="text-decoration-none text-light mx-2">{{ $categoria->nome_categoria }}</a>
                @endforeach
            </div>
            @if($numero_categorias > 5)
                <a href="#" class="text-decoration-none text-light">Mais categorias...</a>
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
