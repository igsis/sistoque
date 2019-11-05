<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'email',
        'password',
        'updated_at',
        'unidades_id',
        'niveis_acessos_id',
        'publicado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function nivelAcesso()
    {
        return $this->belongsTo(NivelAcesso::class, 'niveis_acessos_id', 'id');
    }

    public function pedido()
    {
        return $this->hasMany(Pedido::class, 'usuarios_id', 'id');
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class,'unidades_id','id');
    }
}
