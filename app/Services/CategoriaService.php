<?php

namespace App\Services;

use App\Models\Categoria;

class CategoriaService
{
    public function save(array $data)
    {
        Categoria::create($data);

        return response("Categoria criada com sucesso!", 200);
    }

    public function update(array $data, Categoria $categoria)
    {
        $categoria->update($data);

        return response("Categoria atualizada com sucesso!", 200);
    }

    public function delete(Categoria $categoria)
    {
        $categoria->delete();

        return response("Categoria deletada com sucesso!", 200);
    }
}
