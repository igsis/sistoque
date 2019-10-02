<?php

namespace sitoque\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    public $timestamps = false;

    protected $fillable = [
        'produtos_id',
        'usuarios_id',
        'quantidade',
        'data_pedido'
    ];
}
