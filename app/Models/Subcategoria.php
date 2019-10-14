<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table = 'subcategoria_produtos';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'categoria_produtos_id'
        ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'categoria_produtos_id','id');
    }

    public function produto()
    {
        return $this->hasMany(Produto::class,'subcategoria_produtos_id','id');
    }
}

