<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria_produtos';

    public $timestamps = false;

    protected $fillable = ['nome','publicado'];

    public function subcategoria()
    {
        return $this->hasMany(Subcategoria::class);
    }

    public function produto()
    {
        $this->hasMany(Produto::class);
    }
}
