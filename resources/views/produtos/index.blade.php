@extends('adminlte::page')

@section('title', 'Produtos')

@section('content')
    <h3 class="py-3 d-flex justify-content-between">
        Todos os Produtos

        <a href="{{ route('produtos.create') }}" class="btn btn-success"><i class="fas fa-plus mr-2"></i><span>Cadastrar Produto</span></a>
    </h3>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table tab-le-hover">
                    <thead>
                        <th>Produto</th>
                        <th>Gênero</th>
                        <th>Categoria</th>
                        <th>Valor (R$)</th>
                        <th>Opções</th>
                    </thead>
                    <tbody>
                        @forelse ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome_produto }}</td>
                                <td>{{ $produto->genero }}</td>
                                <td>{{ $produto->categoria->nome_categoria }}</td>
                                <td>{{ $produto->valor }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('produtos.show', ['produto' => $produto]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('produtos.edit', ['produto' => $produto]) }}" class="btn btn-warning mx-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('produtos.delete', ['produto' => $produto]) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Nenhum registro encontrado.</td>
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
