@extends('adminlte::page')

@section('title', 'Criar Categoria')

@section('content')
    <div class="pt-3">
        <h3 class="pb-3 d-flex justify-content-between">
            Nova Categoria

            <a href="{{ route('categorias.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i><span>Voltar</span></a>
        </h3>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('categorias.store') }}" method="post">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="nomeCategoria">Categoria <span class="text-danger">*</span></label>
                            <input required type="text" name="nome_categoria" id="nomeCategoria" class="form-control" value="{{ old('nome_categoria') }}">
                            @error('nome_categoria')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row mt-3">
                        <div class="form-group col-12 d-flex justify-content-end">
                            <input type="submit" class="btn btn-success" value="Salvar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
