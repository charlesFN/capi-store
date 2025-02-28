<?php

namespace App\Livewire\Components;

use App\Models\Produto;
use Livewire\Component;

class Menu extends Component
{
    public $categorias;
    public $pesquisar;

    public $produtos_encontrados;

    public function render()
    {
        $this->produtos_encontrados = Produto::where('nome_produto', 'like', '%'.$this->pesquisar.'%')
                                                ->orderBy('nome_produto')->get();

        return view('livewire.components.menu');
    }
}
