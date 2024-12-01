<div>
    <h3 class="pb-3 d-flex justify-content-between">
        Editar Produto

        <a href="{{ route('produtos.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i><span>Voltar</span></a>
    </h3>

    <div class="card">
        <div class="card-body">
            <form wire:submit="save">
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="nomeProduto">Produto</label>
                        <input required type="text" id="nomeProduto" class="form-control" wire:model.submit="nome_produto">
                        @error('nome_produto')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="nomeCategoria">Categoria</label>
                        <select id="nomeCategoria" class="form-control" wire:model.live="id_categoria">
                            <option value="{{ null }}">Selecione uma categoria</option>
                            @forelse ($categorias as $categoria)
                                <option @if ($categoria->id == $produto->id_categoria) selected @endif value="{{ $categoria->id }}">{{ $categoria->nome_categoria }}</option>
                            @empty
                                <option value="{{ null }}">Não há categorias cadastradas</option>
                            @endforelse
                        </select>
                        @error('id_categoria')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="valorProduto">Preço (R$)</label>
                        <input required type="number" step="0.01" wire:model.submit="valor" id="valorProduto" class="form-control" value="{{ $produto->valor }}">
                        @error('valor')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="">Imagem de capa atual</label>
                        <div class="row">
                            <img src="{{ url($produto->imagem_capa) }}" style="max-width: 100%" />
                            <input type="hidden" wire:model.submit="imagem_capa">
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="novaImagemCapa">Nova imagem de capa</label>
                        <input type="file" wire:model.live="nova_imagem_capa" id="novaImagemCapa" class="form-control">
                        @error('nova_imagem_capa')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="informacoesProduto">Informações do produto</label>
                        <textarea wire:model.submit="informacoes_produto" id="informacoesProduto" cols="30" rows="10" class="form-control">{{ $produto->informacoes_produto }}</textarea>
                    </div>
                </div>

                <h4>Personalizações do Produto</h4>

                <div class="form-group">
                    <label for="">Cores</label>
                    <div class="d-flex w-100">
                        <div class="form-check my-2 mr-2 border rounded-lg w-50">
                            <label class="form-check-label p-2 w-100">
                                <input type="radio" id="cores" class="form-check-input" value="1" wire:model.live="cores">Sim
                            </label>
                        </div>
                        <div class="form-check my-2 mr-2 border rounded-lg w-50">
                            <label class="form-check-label p-2 w-100">
                                <input type="radio" id="cores" class="form-check-input" value="0" wire:model.live="cores">Não
                            </label>
                        </div>
                    </div>
                </div>
                @if ($cores == 1)
                    @if (!empty($cores_disponiveis))
                        <div class="mt-2">
                            @foreach ($cores_disponiveis as $index => $cor)
                                @if ($cor['salvar'] != "nao")
                                    <span class="bg-light py-2 px-3 rounded border">{{ $cor['cor'] }}</span>
                                    <button type="button" wire:click="removerCor({{ $index }}, {{ $cor['id'] }})" class="btn btn-danger rounded-circle mr-2"><i class="fas fa-xmark"></i></button>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <div class="row mt-2">
                        <div class="form-group col-12 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adicionarCor"><i class="fas fa-plus mr-2"></i><span>Adicionar cor</span></button>
                        </div>
                    </div>
                @endif

                <hr>

                <div class="form-group">
                    <label for="">Tamanhos</label>
                    <div class="d-flex w-100">
                        <div class="form-check my-2 mr-2 border rounded-lg w-50">
                            <label class="form-check-label p-2 w-100">
                                <input type="radio" id="tamanhos" class="form-check-input" value="1" wire:model.live="tamanhos">Sim
                            </label>
                        </div>
                        <div class="form-check my-2 mr-2 border rounded-lg w-50">
                            <label class="form-check-label p-2 w-100">
                                <input type="radio" id="tamanhos" class="form-check-input" value="0" wire:model.live="tamanhos">Não
                            </label>
                        </div>
                    </div>
                    @if ($tamanhos == 1)
                        <label for="">Tipo</label>
                        <div class="d-flex w-100">
                            <div class="form-check my-2 mr-2 border rounded-lg w-50">
                                <label class="form-check-label p-2 w-100">
                                    <input type="radio" id="tamanhos" class="form-check-input" value="1" wire:model.live="medidas">Medidas
                                </label>
                            </div>
                            <div class="form-check my-2 mr-2 border rounded-lg w-50">
                                <label class="form-check-label p-2 w-100">
                                    <input type="radio" id="tamanhos" class="form-check-input" value="2" wire:model.live="medidas">Numérico
                                </label>
                            </div>
                        </div>

                        @if ($medidas == 1)
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Selecione as medidas disponíveis</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" wire:model="medidas_disponiveis" value="PP">
                                        <label for="" class="form-check-label">PP</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" wire:model="medidas_disponiveis" value="P">
                                        <label for="" class="form-check-label">P</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" wire:model="medidas_disponiveis" value="M">
                                        <label for="" class="form-check-label">M</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" wire:model="medidas_disponiveis" value="G">
                                        <label for="" class="form-check-label">G</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" wire:model="medidas_disponiveis" value="GG">
                                        <label for="" class="form-check-label">GG</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" wire:model="medidas_disponiveis" value="XG">
                                        <label for="" class="form-check-label">XG</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" wire:model="medidas_disponiveis" value="XGG">
                                        <label for="" class="form-check-label">XGG</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" wire:model="medidas_disponiveis" value="EX">
                                        <label for="" class="form-check-label">EX</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" wire:model="medidas_disponiveis" value="EGG">
                                        <label for="" class="form-check-label">EGG</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-row">
                                        @if (!empty($tabela_medidas))
                                            <label for="">Tabela de medidas atual</label>
                                            <img src="{{ url($tabela_medidas) }}" alt="" class="w-100">
                                        @endif

                                        <label for="tabelaMedidas" class="mt-2">Nova tabela de medidas</label>
                                        <input type="file" accept="image/*" wire:model="nova_tabela_medidas" id="tabelaMedidas" class="form-control w-100">
                                        @error('nova_tabela_medidas')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @elseif ($medidas == 2)
                            @if (!empty($numeros_disponiveis))
                                <div class="mt-2">
                                    @foreach ($numeros_disponiveis as $index => $medida)
                                        <span class="bg-light py-2 px-3 rounded border">{{ $medida['medida'] }}</span>
                                        <button type="button" wire:click="removerNumero({{ $index }})" class="btn btn-danger rounded-circle mr-2"><i class="fas fa-xmark"></i></button>
                                    @endforeach
                                </div>
                            @endif
                            <div class="row mt-2">
                                <div class="form-group col-12 d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adicionarNumero"><i class="fas fa-plus mr-2"></i><span>Adicionar tamanho</span></button>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <hr>

                <div class="form-group">
                    <label for="">Numeração</label>
                    <div class="d-flex w-100">
                        <div class="form-check my-2 mr-2 border rounded-lg w-50">
                            <label class="form-check-label p-2 w-100">
                                <input type="radio" id="numeracao" class="form-check-input" value="1" wire:model.live="numeracao">Sim
                            </label>
                        </div>
                        <div class="form-check my-2 mr-2 border rounded-lg w-50">
                            <label class="form-check-label p-2 w-100">
                                <input type="radio" id="numeracao" class="form-check-input" value="0" wire:model.live="numeracao">Não
                            </label>
                        </div>
                    </div>
                </div>
                <hr>

                <h4>Imagens do Produto</h4>

                @if (!empty($imagens))
                    <div class="form-row">
                        @foreach ($imagens as $index => $imagem)
                            @if ($imagem['salvar'] == null || $imagem['salvar'] == true)
                                @if ($imagem['salvar'] != 'nao')
                                    <div class="col-4 mb-2" style="position: relative; height: 400px;">
                                        <img src="{{ url($imagem['caminho_arquivo']) }}" class="h-100">
                                        <button type="button" wire:click="removerImagem({{ $index }}, {{ $imagem['id'] }})" class="btn btn-danger btn-flutuante rounded-circle"><i class="fas fa-xmark"></i></button>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                @endif

                <div class="form-row">
                    <div class="form-group col-12 d-flex justify-content-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adicionarImagem"><i class="fas fa-plus mr-2"></i><span>Adicionar Imagem</span></button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 d-flex justify-content-end">
                        <input type="submit" value="Atualizar" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Adicionar Cor --}}
    <div id="adicionarCor" class="modal fade" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar cor</h5>
                    <button type="button" class="close" data-dismiss="modal" id="closeModal">&times;</button>
                </div>
                <div class="modal-body">
                    <form wire:submit="adicionarCor">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-12">
                                    <input type="text" wire:model="cor" id="cor" class="form-control">
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-danger mr-2" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Adicionar</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Adicionar Número --}}
    <div id="adicionarNumero" class="modal fade" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar tamanho</h5>
                    <button type="button" class="close" data-dismiss="modal" id="closeModal">&times;</button>
                </div>
                <div class="modal-body">
                    <form wire:submit="adicionarNumero">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-12">
                                    <input type="text" wire:model="numero" id="numero" class="form-control">
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-danger mr-2" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Adicionar</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Adicionar Imagens --}}
    <div class="modal fade" id="adicionarImagem" wire:ignore.self>
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
