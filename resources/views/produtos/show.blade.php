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

            </div>
        </div>
    </div>
@endsection
