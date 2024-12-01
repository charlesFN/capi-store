<div>
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
                                <img src="{{ url($produto->imagem_capa) }}" alt="" class="d-block" style="height: 50vh">
                            </div>
                            @foreach ($produto->imagens as $imagem)
                                <div class="carousel-item">
                                    <img src="{{ url($imagem->url_imagem) }}" alt="" class="d-block" style="height: 50vh">
                                </div>
                            @endforeach
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
                                <img src="{{ url($produto->imagem_capa) }}" alt="" class="carousel-item active object-fit-contain" style="height: 50vh">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-4">
                <h3>{{ $produto->nome_produto }}</h3>
                <h2 class="mt-1" style="color: #1E3A8A">R$ {{ number_format($produto->valor, 2, ',', '.') }}</h2>
                @php
                    $qtd_cores = count($produto->cores)
                @endphp
                @if (!empty($qtd_cores))
                    <div class="row mt-5">
                        <div class="col-12">
                            <span><b>Cor do produto:</b></span><br>
                            @foreach ($produto->cores as $index => $cor)
                                <input type="radio" class="btn-check" id="btn-check-{{ $index }}" name="cor" wire:model.live="cor" value="{{ $cor['cor'] }}">
                                <label class="btn btn-outline-primary" for="btn-check-{{ $index }}">{{ $cor['cor'] }}</label>
                            @endforeach
                        </div>
                    </div>
                @endif
                @php
                    $qtd_produtos = count($produto->tamanhos)
                @endphp
                @if (!empty($qtd_produtos))
                    <div class="row mt-4">
                        <div class="col-12">
                            <span><b>Tamanho do produto:</b></span><br>
                            @foreach ($produto->tamanhos as $index => $medida)
                                <input type="radio" class="btn-check" id="btn-medida-check-{{ $index }}" name="medida" wire:model.live="medida" value="{{ $medida['medida'] }}">
                                <label class="btn btn-outline-primary" for="btn-medida-check-{{ $index }}">{{ $medida['medida'] }}</label>
                            @endforeach
                            <br>
                            @if (!empty($produto->tabela_medidas))
                                <button class="btn mt-1" data-bs-toggle="modal" data-bs-target="#tabelaMedidas">Visualizar tabela de medidas</button>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="row mt-5">
                    <div class="col-12">
                        <button @if (Auth::check() == false) onclick="aviso()" @else href="{{ route('carrinho.comprar', ['id_produto' => $produto->id]) }}" @endif class="btn btn-lg btn-primary w-100">Comprar</button>
                        <button @if (Auth::check() == false) onclick="aviso()" @endif class="btn btn-lg btn-outline-primary w-100 mt-3" @if(Auth::check() == true) data-bs-toggle="modal" data-bs-target="#selecionarQuantidade" @endif>Adicionar ao Carrinho</button>
                    </div>
                </div>
            </div>

            @if(!empty($produto->tabela_medidas))
                <div class="modal fade" id="tabelaMedidas">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img src="{{ url($produto->tabela_medidas) }}" alt="" class="img-fluid">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(Auth::check() == true)
                <div class="modal fade" id="selecionarQuantidade" tabindex="-1" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Selecionar Quantidade</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button @if($qtd_produto == 1) disabled @endif class="btn btn-danger rounded-circle" wire:click="rmvProduto">&minus;</button>
                                    </div>
                                    <div>
                                        <span>{{ $qtd_produto }}</span>
                                    </div>
                                    <div>
                                        <button class="btn btn-success rounded-circle" wire:click="addProduto">&plus;</button>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h3>R$ {{ number_format($valor_venda, 2, ',', '.') }}</h3>
                                </div>

                                <form action="{{ route('carrinho.adicionar') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="id_produto" value="{{ $produto->id }}">
                                    <input type="hidden" name="qtd_produtos" value="{{ $qtd_produto }}">
                                    <button @if ($qtd_produto == 0) disabled @endif type="submit" class="btn btn-lg btn-dark w-100 mt-4">Adicionar ao Carrinho</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if($produto->informacoes_produto)
            <div class="row mt-5">
                <h4>Descrição do produto</h4>
                <p>
                    {{ $produto->informacoes_produto }}
                </p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function aviso()
        {
            Swal.fire({
                title: "Atenção!",
                text: "É necessário realizar o login para comprar ou adicionar produtos ao carrinho.",
                icon: "warning"
            })
        }
    </script>
</div>
