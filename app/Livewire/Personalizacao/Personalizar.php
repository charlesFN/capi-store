<?php

namespace App\Livewire\Personalizacao;

use Livewire\Component;
use App\Models\Modalidade;

class Personalizar extends Component
{
    public $modalidades;

    public $participa_modalidade = false;

    public $numero;
    public $nome;

    public function mount()
    {
        $this->modalidades = Modalidade::all();


        $qtd_numero = 0;
        $qtd_nome = 0;

        foreach (session('carrinho') as $key => $produto) {
            if ($produto['numeracao'] > 0) {
                $qtd_numero++;
            }
            if ($produto['nome_cliente']  > 0) {
                $qtd_nome++;
            }

            if ($qtd_numero > 0) {
                $this->numero = true;
            }
            if ($qtd_nome > 0) {
                $this->nome = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.personalizacao.personalizar');
    }
}
