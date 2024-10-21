@extends('adminlte::page')

@section('title', 'Categorias')

@section('content')
    <h3 class="py-3 d-flex justify-content-between">
        Todas as Categorias de Produtos

        <a href="{{ route('categorias.create') }}" class="btn btn-success"><i class="fas fa-plus mr-2"></i><span>Criar Categoria</span></a>
    </h3>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th>Categoria</th>
                        <th>Qtd. Produtos</th>
                        <th>Opções</th>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->nome_categoria }}</td>
                                <td>{{ count($categoria->produtos) }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('categorias.show', ['categoria' => $categoria]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('categorias.edit', ['categoria' => $categoria]) }}" class="btn btn-warning mx-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('categorias.delete', ['categoria' => $categoria]) }}" method="post">
                                        @csrf
                                        @method('DELETE')

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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Atenção!",
                text: "{{ session('error') }}",
                icon: "error"
            })
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Atenção!",
                text: "{{ session('success') }}",
                icon: "success"
            })
        </script>
    @endif
@endsection
