<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    public $timestamps = false;

    protected $fillable = [
        'produtos_id',
        'usuarios_id',
        'quantidade',
        'data_pedido',
        'status_pedidos_id',
        'publicado',
    ];

    public function status(){
        return $this->belongsTo(Status::class,'status_pedidos_id',  'id');
    }

    public function produto(){
        return $this->belongsTo(Produto::class,'produtos_id','id');
    }
}
