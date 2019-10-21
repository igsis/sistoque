<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status_pedidos';

    public $timestamps = false;

    protected $fillable = [
        'status',

    ];

    public function pedido(){
        return $this->hasMany(Pedido::class);
    }
}
