<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorProduto extends Model
{
    use HasFactory;

    protected $table = "cores_produtos";

    protected $fillable = [
        'id_produto',
        'cor'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }
}
