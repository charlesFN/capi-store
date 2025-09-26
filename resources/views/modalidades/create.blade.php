@extends('adminlte::page')

@section('title', 'Criar Modalidade')

@section('content')
    <div class="pt-3">
        <h3 class="pb-3 d-flex justify-content-between">
            Nova Modalidade

            <a href="{{ route('modalidades.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i><span>Voltar</span></a>
        </h3>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('modalidades.store') }}" method="post">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="nomeModalidade">Modalidade <span class="text-danger">*</span></label>
                            <input required type="text" name="nome_modalidade" id="nomeModalidade" class="form-control" value="{{ old('nome_modalidade') }}">
                            @error('nome_modalidade')
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
