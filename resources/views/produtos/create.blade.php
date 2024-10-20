@extends('adminlte::page')

@section('title', 'Cadastrar Produto')

@section('content')
    <div class="pt-3">
        <h3 class="pb-3 d-flex justify-content-between">
            Novo Produto

            <a href="{{ route('produtos.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i><span>Voltar</span></a>
        </h3>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('produtos.store') }}" method="post">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="nomeProduto">Produto <span class="text-danger">*</span></label>
                            <input required type="text" name="nome_produto" id="nomeProduto" class="form-control" value="{{ old('nome_produto') }}">
                            @error('nome_produto')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="nomeCategoria">Categoria <span class="text-danger">*</span></label>
                            <select name="id_categoria" id="nomeCategoria" class="form-control">
                                <option value="">Selecione uma categoria</option>
                                @forelse ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nome_categoria }}</option>
                                @empty
                                    <option value="">Não há categorias cadastradas</option>
                                @endforelse
                            </select>
                            @error('id_categoria')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="generoProduto">Gênero <span class="text-danger">*</span></label>
                            <select required name="genero" id="generoProduto" class="form-control">
                                <option value="Nenhum">Nenhum</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Unissex">Unissex</option>
                            </select>
                            @error('genero')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="valorProduto">Valor (R$) <span class="text-danger">*</span></label>
                            <input required type="number" step="0.01" name="valor" id="valorProduto" class="form-control" value="{{ old('valor') }}">
                            @error('valor')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 d-flex justify-content-end">
                            <input type="submit" value="Cadastrar" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
