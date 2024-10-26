@extends('adminlte::page')

@section('title', 'Cadastrar Produto')

@section('content')
    <div class="pt-3">
        <livewire:produtos.create :categorias="$categorias" />
    </div>
@endsection
