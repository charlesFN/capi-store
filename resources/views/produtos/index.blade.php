@extends('adminlte::page')

@section('title', 'Produtos')

@section('content')
    <h3 class="py-3 d-flex justify-content-between">
        Todos os Produtos

        <a href="{{ route('produtos.create') }}" class="btn btn-success"><i class="fas fa-plus mr-2"></i><span>Adicionar Produto</span></a>
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
                                    <button onclick="excluirProduto(`{{ $produto->id }}`)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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

    {{-- Formulário de exclusão de produtos --}}
    <form action="{{ route('produtos.delete') }}" method="post" id="excluirProduto">
        @csrf
        @method('DELETE')

        <input type="hidden" name="id_produto" id="idProduto">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function excluirProduto(idProduto) {
            Swal.fire({
                title: "Deseja deletar este produto?",
                text: "Você não será capaz de reverter isto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, prosseguir!",
                cancelButtonText: "Não, cancelar!"
            }).then((result) => {
                if(result.isConfirmed) {
                    document.getElementById('idProduto').value = idProduto;
                    $("#excluirProduto").submit();
                }
            })
        }
    </script>

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
