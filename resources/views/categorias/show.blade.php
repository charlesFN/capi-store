@extends('adminlte::page')

@section('title', "Categoria - $categoria->nome_categoria")

@section('content')
    <h3 class="py-3 d-flex justify-content-between">
        {{ $categoria->nome_categoria }}

        <a href="{{ route('categorias.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i><span>Voltar</span></a>
    </h3>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <h6>Produtos da Categoria</h6>
                    <thead>
                        <th>Produto</th>
                        <th>Valor (R$)</th>
                    </thead>
                    <tbody>
                        @forelse ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome_produto }}</td>
                                <td>R$ {{ number_format($produto->valor, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Nenhum registro encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
