<?php

namespace sitoque\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table = 'subcategoria_produtos';

    public $timestamps = false;

    protected $fillable = ['sub_categoria'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function produto()
    {
        return $this->hasMany(Produto::class);
    }
}

