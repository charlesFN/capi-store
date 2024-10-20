@extends('adminlte::page')

@section('title', "Editar Produto - $produto->nome_produto")

@section('content')
    <div class="pt-3">
        <h3 class="pb-3 d-flex justify-content-between">
            Editar Produto

            <a href="{{ route('produtos.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i><span>Voltar</span></a>
        </h3>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('produtos.update', ['produto' => $produto]) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="nomeProduto">Produto <span class="text-danger">*</span></label>
                            <input required type="text" name="nome_produto" id="nomeProduto" class="form-control" value="{{ $produto->nome_produto }}">
                            @error('nome_produto')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="nomeCategoria">Categoria <span class="text-danger">*</span></label>
                            <select name="id_categoria" id="nomeCategoria" class="form-control">
                                <option value="">Selecione uma categoria</option>
                                @forelse ($categorias as $categoria)
                                    <option @if($categoria->nome_categoria == $produto->categoria->nome_categoria)
                                        selected
                                    @endif value="{{ $categoria->id }}">{{ $categoria->nome_categoria }}</option>
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
                                <option @if ($produto->genero == "Nenhum") selected @endif value="Nenhum">Nenhum</option>
                                <option @if ($produto->genero == "Feminino") selected @endif value="Feminino">Feminino</option>
                                <option @if ($produto->genero == "Masculino") selected @endif value="Masculino">Masculino</option>
                                <option @if ($produto->genero == "Unissex") selected @endif value="Unissex">Unissex</option>
                            </select>
                            @error('genero')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="valorProduto">Valor (R$) <span class="text-danger">*</span></label>
                            <input required type="number" step="0.01" name="valor" id="valorProduto" class="form-control" value="{{ $produto->valor }}">
                            @error('valor')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row col-12 mt-3 d-flex justify-content-end">
                        <a href="{{ route('produtos.index') }}" class="btn btn-danger mr-3">Cancelar</a>
                        <input type="submit" class="btn btn-success" value="Atualizar">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
