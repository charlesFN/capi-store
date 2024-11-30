<?php

namespace App\Services;

use App\Models\CorProduto;
use App\Models\ImagensProduto;
use App\Models\Produto;
use App\Models\TamanhoProduto;

class ProdutoService
{
    public function save(array $data, array $cores, array $medidas, array $numeros, array $imagens)
    {
        $produto = Produto::create($data);

        if (!empty($cores)) {
            foreach ($cores as $cor) {
                CorProduto::create([
                    'id_produto' => $produto->id,
                    'cor' => $cor['cor']
                ]);
            }
        }

        if (!empty($medidas)) {
            foreach ($medidas as $medida) {
                TamanhoProduto::create([
                    'id_produto' => $produto->id,
                    'medida' => $medida
                ]);

                $produto->update([
                    "tipo_tamanho" => 1
                ]);
            }
        }

        if (!empty($numeros)) {
            foreach ($numeros as $numero) {
                TamanhoProduto::create([
                    'id_produto' => $produto->id,
                    'medida' => $numero['medida']
                ]);

                $produto->update([
                    "tipo_tamanho" => 2
                ]);
            }
        }

        if (!empty($imagens)) {
            foreach ($imagens as $imagem) {
                ImagensProduto::create([
                    'id_produto' => $produto->id,
                    'url_imagem' => $imagem['caminho_arquivo']
                ]);
            }
        }

        return response("Produto adicionado com sucesso!", 200);
    }

    public function update(array $data, $cores, Produto $produto)
    {
        /* dd($data); */
        /* dd($cores); */

        if (!empty($cores)) {
            foreach ($cores as $cor) {
                if ($cor['salvar'] == "sim") {
                    CorProduto::create([
                        'id_produto' => $produto->id,
                        'cor' => $cor['cor']
                    ]);
                } elseif ($cor['salvar'] == "nao") {
                    CorProduto::destroy($cor['id']);
                }
            }
        } else {
            $qtd_cores = count($produto->cores);

            if ($qtd_cores != 0) {
                $produto->cores()->delete();
            }
        }

        /* $produto->update($data); */

        return response("Produto atualizado com sucesso!", 200);
    }

    public function delete($id_produto)
    {
        $produto = Produto::findOrFail($id_produto);
        $produto->delete();

        return response("Produto deletado com sucesso!", 200);
    }
}
