<div>
    {{-- {{ dd(session('carrinho')) }} --}}
    <div class="container mt-4">
        <div class="row">
            <div class="col-8">
                @if(session()->has('carrinho'))
                    @foreach (session('carrinho') as $key => $produto)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img class="img-fluid" src="{{ url($produto['imagem']) }}" alt="">
                                    </div>
                                    <div class="col-4">
                                        <h6>{{ $produto['nome'] }}</h6>
                                        <p>
                                            @if(isset($produto['tamanho'])) Tamanho: <br> @endif
                                            @if(isset($produto['cor'])) Cor: @endif
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <div>
                                            @if($produto['quantidade'] == 1) <button type="button" wire:click="removerProduto({{ $key }})" class="btn btn-outline-danger rounded-circle"><i class="fas fa-trash"></i></button> @endif
                                            @if($produto['quantidade'] > 1) <button type="button" wire:click="subtrairProduto({{ $key }})" class="btn btn-outline-danger rounded-circle"><i class="fas fa-minus"></i></button> @endif
                                            <span class="mx-2">{{ $produto['quantidade'] }}</span>
                                            <button type="button" wire:click="adicionarProduto({{ $key }})" class="btn btn-outline-success rounded-circle"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <h5>R$ {{ number_format($produto['preco'], 2, ',', '.') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @if (session()->has('carrinho'))
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6>Total</h6>
                                @php
                                    $valor_total = 0;
                                @endphp

                                @foreach (session('carrinho') as $produto)
                                    @php
                                        $valor_produto = $produto['preco'] * $produto['quantidade'];
                                        $valor_total = $valor_total + $valor_produto;
                                    @endphp
                                @endforeach
                                <h5>R$ {{ number_format($valor_total, 2, ',', '.') }}</h5>
                            </div>

                            <button wire:click="comprar" class="btn btn-lg btn-success w-100 mt-4">Comprar</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
