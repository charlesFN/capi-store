<?php

namespace App\Services;

use App\Models\Produto;

class ProdutoService
{
    public function save(array $data)
    {
        Produto::create($data);

        return response("Produto cadastrado com sucesso!", 200);
    }

    public function update(array $data, Produto $produto)
    {
        $produto->update($data);

        return response("Produto atualizado com sucesso!", 200);
    }

    public function delete($id_produto)
    {
        $produto = Produto::findOrFail($id_produto);
        $produto->delete();

        return response("Produto deletado com sucesso!", 200);
    }
}
