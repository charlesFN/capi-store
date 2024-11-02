@extends('adminlte::page')

@section('title', 'Cadastrar Produto')

@push('css')
    <style>
        .btn-flutuante {
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 1000;
        }
        .btn-flutuante {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
@endpush

@section('content')
    <div class="pt-3">
        <livewire:produtos.create :categorias="$categorias" />
    </div>

    @if (session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            Swal.fire({
                title: "Atenção!",
                text: "{{ session('error') }}",
                icon: "error"
            })
        </script>
    @endif
@endsection
