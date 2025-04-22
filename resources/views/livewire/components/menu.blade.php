<div>
    <nav class="navbar border-bottom px-5" style="background-color: #F59E0B">
        <div class="container-fluid">
            <a href="{{ route('home') }}" class="navbar-brand mx-4">
                <img src="{{ asset('img/logo-site.png') }}" alt="" width="90" height="90">
            </a>
            <div class="mx-auto position-relative w-50">
                <input type="search" class="form-control" id="searchInput" placeholder="O que você procura?" wire:model.live="pesquisar">
                <div class="search-results p-2 {{ $pesquisar == '' ? 'd-none' : '' }}" id="searchResults">
                    @forelse ($produtos_encontrados as $produto)
                        <a href="{{ route('produto.show', ['id' => $produto->id]) }}" class="fw-bold" style="text-decoration: none; color: #1E3A8A;">{{ $produto->nome_produto }}</a>
                    @empty
                        Nenhum item encontrado.
                    @endforelse
                </div>
            </div>
            <div>
                @if (Auth::check() == true && auth()->user()->is_admin == true)
                    <a href="{{ route('categorias.index') }}" class="text-decoration-none text-light mx-1">Dashboard</a>
                    <span class="text-light mx-1">|</span>
                    <a href="#" class="text-decoration-none text-light mx-1" onclick="logout()"><i class="fas fa-power-off"></i> Sair</a>
                @elseif (Auth::check() == true && auth()->user()->is_admin == false)
                    <a href="{{ route('carrinho') }}" class="text-decoration-none text-light mx-1"><i class="fas fa-cart-shopping"></i></a>
                    <span class="text-light mx-1">|</span>
                    <a href="#" class="text-decoration-none text-light mx-1" onclick="logout()"><i class="fas fa-power-off"></i> Sair</a>
                @elseif (Auth::check() == false)
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('login') }}" class="text-decoration-none text-light mx-1">Entre</a>
                            <span class="text-light">ou</span>
                            <a href="{{ route('register') }}" class="text-decoration-none text-light mx-1">Cadastre-se</a>
                        </div>
                        <div>
                            <a href="{{ route('carrinho') }}" class="text-decoration-none text-light mx-4"><i class="fas fa-cart-shopping"></i></a>
                        </div>
                    </div>
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
                <div class="row">
                    <div>
                        @foreach ($categorias as $categoria)
                            <a href="" class="text-decoration-none mx-5 fw-bold" style="color: #1E3A8A">{{ $categoria->nome_categoria }}</a>
                        @endforeach
                    </div>
                    @if($numero_categorias > 5)
                        <a href="#" class="text-decoration-none mx-5 fw-bold" style="color: #1E3A8A">Mais categorias...</a>
                    @endif
                </div>
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
</div>
