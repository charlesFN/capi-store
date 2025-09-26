@extends('adminlte::page')

@section('title', "Editar Modalidade - $modalidade->nome_modalidade")

@section('content')
<div class="pt-3">
    <h3 class="pb-3 d-flex justify-content-between">
        Editar Modalidade

        <a href="{{ route('modalidades.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i><span>Voltar</span></a>
    </h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('modalidades.update', ['modalidade' => $modalidade]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-row col-12">
                    <label for="nomeModalidade">Nome da Modalidade</label>
                    <input required type="text" name="nome_modalidade" id="nomeModalidade" class="form-control" value="{{ $modalidade->nome_modalidade }}">
                    @error('nome_modalidade')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row col-12 mt-3 d-flex justify-content-end">
                    <a href="{{ route('modalidades.index') }}" class="btn btn-danger mr-3">Cancelar</a>
                    <input type="submit" class="btn btn-success" value="Atualizar">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
