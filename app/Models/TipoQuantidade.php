<?php

namespace sitoque\Models;

use Illuminate\Database\Eloquent\Model;

class TipoQuantidade extends Model
{
    protected $table = 'tipo_quantidades';

    public $timestamps = false;

    protected $fillable = ['tipo'];
}
