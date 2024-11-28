<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TamanhoProduto extends Model
{
    use HasFactory;

    protected $table = "tamanhos_produtos";

    protected $fillable = [
        'id_produto',
        'medida'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }
}
