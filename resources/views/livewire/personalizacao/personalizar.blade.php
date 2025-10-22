<div class="container mt-4">
    <form wire:submit="ir_pagamento">
        @if($this->nome == true)
            <div class="form-group">
                <h4>Deseja colocar um nome?</h4>
                <div class="d-flex w-100">
                    <div class="form-check my-2 mr-2 border rounded-lg w-50">
                        <label class="form-check-label p-2 w-100">
                            <input type="radio" id="deseja_nome" class="form-check-input" value="1" wire:model.live="deseja_nome">Sim
                        </label>
                    </div>
                    <div class="form-check my-2 mr-2 border rounded-lg w-50">
                        <label class="form-check-label p-2 w-100">
                            <input type="radio" id="deseja_nome" class="form-check-input" value="0" wire:model.live="deseja_nome">Não
                        </label>
                    </div>
                </div>

                @if($this->deseja_nome == true)
                    <div class="form-group">
                        <label for="nome_cliente">Nome</label>
                        <input type="text" wire:model="nome" class="form-control">
                    </div>
                @endif
            </div>
        @endif

        @if($this->numero == true)
            <h4>Deseja colocar um número?</h4>
            <div class="d-flex w-100">
                <div class="form-check my-2 mr-2 border rounded-lg w-50">
                    <label class="form-check-label p-2 w-100">
                        <input type="radio" id="deseja_numero" class="form-check-input" value="1" wire:model.live="deseja_numero">Sim
                    </label>
                </div>
                <div class="form-check my-2 mr-2 border rounded-lg w-50">
                    <label class="form-check-label p-2 w-100">
                        <input type="radio" id="deseja_numero" class="form-check-input" value="0" wire:model.live="deseja_numero">Não
                    </label>
                </div>
            </div>

            @if($this->deseja_numero == true)
                <h4>Você faz parte de alguma modalidade da atlética?</h4>
                <div class="d-flex w-100">
                    <div class="form-check my-2 mr-2 border rounded-lg w-50">
                        <label class="form-check-label p-2 w-100">
                            <input type="radio" id="participa_modalidade" class="form-check-input" value="1" wire:model.live="participa_modalidade">Sim
                        </label>
                    </div>
                    <div class="form-check my-2 mr-2 border rounded-lg w-50">
                        <label class="form-check-label p-2 w-100">
                            <input type="radio" id="participa_modalidade" class="form-check-input" value="0" wire:model.live="participa_modalidade">Não
                        </label>
                    </div>
                </div>

                @for($i = 0; $i < 100; $i++)
                    <input type="radio" class="btn-check" id="btn-check-{{ $i }}" name="numero" wire:model.live="numero" value="{{ $i }}">
                    <label class="btn btn-outline-primary" for="btn-check-{{ $i }}">{{ $i }}</label>
                @endfor
            @endif
        @endif

        <div>
            <div id="wallet_container"></div>

            <button type="submit" class="btn btn-success w-100 mt-4">Ir para o pagamento</button>
        </div>
    </form>
</div>
