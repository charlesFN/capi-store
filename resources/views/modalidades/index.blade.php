@extends('adminlte::page')

@section('title', 'Modalidades')

@section('content')
    <h3 class="py-3 d-flex justify-content-between">
        Todas as Modalidades

        <a href="{{ route('modalidades.create') }}" class="btn btn-success"><i class="fas fa-plus mr-2"></i><span>Criar Modalidade</span></a>
    </h3>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th>Modalidade</th>
                        {{-- <th>Qtd. Clientes</th> --}}
                        <th>Opções</th>
                    </thead>
                    <tbody>
                        @forelse ($modalidades as $modalidade)
                            <tr>
                                <td>{{ $modalidade->nome_modalidade }}</td>
                                {{-- <td>{{ count($modalidade->produtos) }}</td> --}}
                                <td class="d-flex">
                                    <a href="{{ route('modalidades.show', ['modalidade' => $modalidade]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('modalidades.edit', ['modalidade' => $modalidade]) }}" class="btn btn-warning mx-2"><i class="fas fa-edit"></i></a>
                                    <button {{-- @if(count($modalidade->produtos) > 0) onclick="alertaCategoria()" @else  --}}onclick="excluirModalidade(`{{ $modalidade->id }}`)" {{-- @endif --}} class="btn btn-danger"><i class="fas fa-trash"></i></button>
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

    {{-- Formulário de exclusão de modalidade --}}
    <form action="{{ route('modalidades.delete') }}" method="post" id="excluirModalidade">
        @csrf
        @method('DELETE')

        <input type="hidden" name="id_modalidade" id="idModalidade">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        /* function alertaCategoria() {
            Swal.fire({
                title: "Atenção!",
                text: "Há um ou mais produtos nesta categoria, portanto ela não pode ser deletada",
                icon: 'warning'
            })
        } */
        function excluirModalidade(idModalidade) {
            Swal.fire({
                title: "Deseja deletar esta modalidade?",
                text: "Você não será capaz de reverter isto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, prosseguir!",
                cancelButtonText: "Não, cancelar!"
            }).then((result) => {
                if(result.isConfirmed) {
                    document.getElementById('idModalidade').value = idModalidade;
                    $("#excluirModalidade").submit();
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
