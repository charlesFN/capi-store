<div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h4>Você faz parte de alguma modalidade da atlética?</h4>

                <form action="" method="POST">
                    @csrf

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

                    @if($this->nome == true)
                        <h4>Deseja colocar um nome?</h4>

                        <div class="form-group">
                            <label for="nome_cliente">Nome</label>
                            <input type="text" name="nome_cliente" id="nome_cliente">
                        </div>
                    @endif

                    @if($this->numero == true)
                        <h4>Deseja colocar um número?</h4>

                        <div class="form-group">
                            Container Número
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
