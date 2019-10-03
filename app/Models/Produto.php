<?php

namespace sitoque\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'quantidade',
        'nivel_emergencia',
        'categoria_produto_id',
        'subcategoria_produtos_id',
        'tipo_quantidades_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }
}

