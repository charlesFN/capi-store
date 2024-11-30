@extends('adminlte::page')

@section('title', "Editar Produto - $produto->nome_produto")

@push('css')
    <style>
        .btn-flutuante {
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 1000;
        }
        .btn-flutuante {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
@endpush

@section('content')
    <div class="pt-3">
        <livewire:produtos.edit :categorias="$categorias" :produto="$produto" />
    </div>
@endsection
