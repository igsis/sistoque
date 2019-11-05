<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';

    public $timestamps = false;

    protected $fillable = [
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado'
    ];

    public function unidade()
    {
        return $this->hasMany(Unidade::class, 'endereco_id','id');
    }
}
