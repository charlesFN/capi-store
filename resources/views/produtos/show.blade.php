@extends('adminlte::page')

@section('title', "Produto - $produto->nome_produto")

@section('content')
    <h3 class="py-3 d-flex justify-content-between">
        {{ $produto->nome_produto }}

        <a href="{{ route('produtos.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i><span>Voltar</span></a>
    </h3>

    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="nomeProduto">Produto <span class="text-danger">*</span></label>
                    <input disabled type="text" id="nomeProduto" class="form-control" value="{{ $produto->nome_produto }}">
                </div>
                <div class="form-group col-4">
                    <label for="nomeCategoria">Categoria <span class="text-danger">*</span></label>
                    <input disabled type="text" id="nomeCategoria" class="form-control" value="{{ $produto->categoria->nome_categoria }}">
                </div>
                <div class="form-group col-4">
                    <label for="valorProduto">Valor (R$) <span class="text-danger">*</span></label>
                    <input disabled type="number" id="valorProduto" class="form-control" value="{{ $produto->valor }}">
                </div>
            </div>
            <div class="row d-flex">
                @foreach ($produto->imagens as $imagem)
                    <div class="col-4 mb-3">
                        <img class="w-100" src="{{ url($imagem->url_imagem) }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
