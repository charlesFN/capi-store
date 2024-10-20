@extends('adminlte::page')

@section('title', "Editar Categoria - $categoria->nome_categoria")

@section('content')
<div class="pt-3">
    <h3 class="pb-3 d-flex justify-content-between">
        Editar Categoria

        <a href="{{ route('categorias.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i><span>Voltar</span></a>
    </h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categorias.update', ['categoria' => $categoria]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-row col-12">
                    <label for="nomeCategoria">Nome da Categoria</label>
                    <input required type="text" name="nome_categoria" id="nomeCategoria" class="form-control" value="{{ $categoria->nome_categoria }}">
                    @error('nome_categoria')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row col-12 mt-3 d-flex justify-content-end">
                    <a href="{{ route('categorias.index') }}" class="btn btn-danger mr-3">Cancelar</a>
                    <input type="submit" class="btn btn-success" value="Atualizar">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
