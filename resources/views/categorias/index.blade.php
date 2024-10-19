@extends('adminlte::page')

@section('title', 'Categorias')

@section('content')
    <h3 class="py-3 d-flex justify-content-between">
        Todas as Categorias de Produtos

        <a href="{{ route('categorias.create') }}" class="btn btn-success"><i class="fas fa-plus mr-2"></i><span>Criar Categoria</span></a>
    </h3>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead {{-- class="thead-light" --}}>
                <th>Nome</th>
                <th>Qtd. Produtos</th>
                <th>Opções</th>
            </thead>
            <tbody>
                @forelse ($categorias as $categoria)
                    <tr>
                        <td>
                            {{ $categoria->nome_categoria }}
                        </td>
                        <td>
                            0
                        </td>
                        <td class="d-flex">
                            <a href="" class="btn btn-info"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('categorias.edit', ['categoria' => $categoria]) }}" class="btn btn-warning mx-2"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('categorias.delete') }}" method="post">
                                @csrf
                                @method('DELETE')

                                <input type="hidden" name="id" value="{{ $categoria->id }}">
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Nenhum registro encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
@endsection
