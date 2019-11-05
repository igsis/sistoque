<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $table = 'unidades';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'telefone',
        'endereco_id',
        'publicado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function endereco()
    {
        return $this->hasMany(Endereco::class, 'endereco_id', 'id');
    }
}
