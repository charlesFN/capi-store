@extends('adminlte::page')

@section('title', "Produto - $produto->nome_produto")

@section('content')
    <h3 class="py-3 d-flex justify-content-between">
        {{ $produto->nome_produto }}

        <a href="{{ route('produtos.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i><span>Voltar</span></a>
    </h3>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <img src="{{ url($produto->imagem_capa) }}" style="max-width: 100%">
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-12">
                            <label>Produto</label>
                            <p class="bg-light py-2 px-3 rounded border" style="width: 100%">{{ $produto->nome_produto }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Categoria</label>
                            <p class="bg-light py-2 px-3 rounded border" style="width: 100%">{{ $produto->categoria->nome_categoria }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Preço</label>
                            <p class="bg-light py-2 px-3 rounded border" style="width: 100%">R$ {{ number_format($produto->valor, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($produto->informacoes_produto))
                <div class="row mt-3">
                    <div class="col-12">
                        <label>Informações do produto</label>
                        <textarea disabled cols="30" rows="10" class="form-control">{{ $produto->informacoes_produto }}</textarea>
                    </div>
                </div>
            @endif

            @php
                $qtd_cores = count($produto->cores);
            @endphp
            @if (!empty($qtd_cores))
                <div class="row mt-4">
                    <div class="col-12">
                        <label class="mb-3">Cores do produto</label><br>
                        @foreach ($produto->cores as $cor)
                            <span class="bg-light py-2 px-3 mx-1 rounded border">{{ $cor['cor'] }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @php
                $qtd_tamanhos = count($produto->tamanhos)
            @endphp
            @if (!empty($qtd_tamanhos))
                <div class="row mt-4">
                    <div class="col-12">
                        <label class="mb-3">Tamanhos do produto</label><br>
                        @foreach ($produto->tamanhos as $tamanho)
                            <span class="bg-light py-2 px-3 mx-1 rounded border">{{ $tamanho['medida'] }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @php
                $qtd_imagens = count($produto->imagens)
            @endphp
            @if (!empty($qtd_imagens))
                <label class="mt-4 mb-3">Imagens do produto</label><br>
                <div class="row">
                    @foreach ($produto->imagens as $imagem)
                        <div class="col-4 mb-2" style="height: 400px;">
                            <img src="{{ url($imagem['url_imagem']) }}" class="h-100">
                        </div>
                    @endforeach
                    <br>
                    @if (!empty($produto->tabela_medidas))
                        <button class="btn mt-1" data-toggle="modal" data-target="#tabelaMedidas">Visualizar tabela de medidas</button>
                    @endif
                </div>
            @endif
        </div>

        @if(!empty($produto->tabela_medidas))
            <div class="modal fade" id="tabelaMedidas">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ url($produto->tabela_medidas) }}" alt="" class="img-fluid">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
