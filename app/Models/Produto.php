<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'quantidade',
        'nivel_emergencia',
        'categoria_produtos_id',
        'subcategoria_produtos_id',
        'tipo_quantidades_id',
        'publicado'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'categoria_produtos_id','id');
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class,'subcategoria_produtos_id','id');
    }
}

