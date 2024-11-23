<div>
    <h3 class="pb-3 d-flex justify-content-between">
        Novo Produto

        <a href="{{ route('produtos.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i><span>Voltar</span></a>
    </h3>

    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="save" method="post">
                @csrf

                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="nomeProduto">Produto <span class="text-danger">*</span></label>
                        <input required type="text" wire:model.submit="nome_produto" id="nomeProduto" class="form-control" value="{{ old('nome_produto') }}">
                        @error('nome_produto')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="nomeCategoria">Categoria <span class="text-danger">*</span></label>
                        <select wire:model.submit="id_categoria" id="nomeCategoria" class="form-control">
                            <option value="">Selecione uma categoria</option>
                            @forelse ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome_categoria }}</option>
                            @empty
                                <option value="">Não há categorias cadastradas</option>
                            @endforelse
                        </select>
                        @error('id_categoria')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="imagemCapa">Imagem de capa <span class="text-danger">*</span></label>
                        <input type="file" name="imagem_capa" wire:model.submit="imagem_capa" id="imagemCapa" class="form-control">
                        @error('imagem_capa')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="valorProduto">Valor (R$) <span class="text-danger">*</span></label>
                        <input required type="number" step="0.01" wire:model.submit="valor" id="valorProduto" class="form-control" value="{{ old('valor') }}">
                        @error('valor')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                @if(!empty($imagens))
                    @foreach ($imagens as $index => $imagem)
                        <div class="form-row">
                            <div class="col-4 mb-2" style="position: relative; height: 200px;">
                                <img src="{{ url($imagem['caminho_arquivo']) }}" class="w-100">
                                <button type="button" wire:click="removerImagem({{ $index }})" class="btn btn-danger btn-flutuante rounded-circle"><i class="fas fa-xmark"></i></button>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="form-row">
                    <div class="form-group col-12 d-flex justify-content-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adicionarImagem"><i class="fas fa-plus mr-2"></i><span>Adicionar Imagem</span></button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 d-flex justify-content-end">
                        <input type="submit" value="Salvar" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Adicionar Imagens --}}
    <div class="modal fade" id="adicionarImagem" wire:ignore>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Imagem</h5>
                    <button type="button" class="close" data-dismiss="modal" id="closeModal">&times;</button>
                </div>
                <div class="modal-body">
                    <form wire:submit="adicionarImagem" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-12">
                                <input class="form-control" type="file" accept="image/*" wire:model="imagem">
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn btn-danger mr-2" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Adicionar</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
