<?php

namespace App\Services;

use App\Models\ImagensProduto;
use App\Models\Produto;

class ProdutoService
{
    public function save(array $data, array $imagens)
    {
        $produto = Produto::create($data);

        foreach ($imagens as $imagem) {
            ImagensProduto::create([
                'id_produto' => $produto->id,
                'url_imagem' => $imagem['caminho_arquivo']
            ]);
        }

        return response("Produto adicionado com sucesso!", 200);
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
