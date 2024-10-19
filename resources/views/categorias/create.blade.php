@extends('adminlte::page')

@section('title', 'Criar Categoria')

@section('content')
    <div class="container pt-3">
        <form action="{{ route('categorias.store') }}" method="post">
            @csrf

            <div class="form-row col-12">
                <label for="nomeCategoria">Nome da Categoria</label>
                <input required type="text" name="nome_categoria" id="nomeCategoria" class="form-control" value="{{ old('nome_categoria') }}">
                @error('nome_categoria')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-row col-12 mt-3 d-flex justify-content-end">
                <input type="submit" class="btn btn-success" value="Salvar">
            </div>
        </form>
    </div>
@endsection
