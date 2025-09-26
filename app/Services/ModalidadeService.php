<?php

namespace App\Services;

use App\Models\Modalidade;

class ModalidadeService
{
    public function save(array $data)
    {
        Modalidade::create($data);

        return response("Modalidade criada com sucesso!", 200);
    }

    public function update(array $data, Modalidade $modalidade)
    {
        $modalidade->update($data);

        return response("Modalidade atualizada com sucesso!", 200);
    }

    public function delete($id_modalidade)
    {
        $modalidade = Modalidade::findOrFail($id_modalidade);
        $modalidade->delete();

        return response("Modalidade deletada com sucesso!", 200);
    }
}
