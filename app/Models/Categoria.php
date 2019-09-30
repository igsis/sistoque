<?php

namespace sitoque\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria_produtos';

    public $timestamps = false;

    protected $fillable = ['nome'];
}
