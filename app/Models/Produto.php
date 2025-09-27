<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_categoria",
        "nome_produto",
        "imagem_capa",
        "informacoes_produto",
        "numeracao",
        "valor",
        "tabela_medidas",
        "tipo_tamanho",
        "nome_cliente"
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function imagens()
    {
        return $this->hasMany(ImagensProduto::class, 'id_produto');
    }

    public function cores()
    {
        return $this->hasMany(CorProduto::class, 'id_produto');
    }

    public function tamanhos()
    {
        return $this->hasMany(TamanhoProduto::class, 'id_produto');
    }
}
