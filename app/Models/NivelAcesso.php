<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelAcesso extends Model
{
    protected $table = 'niveis_acessos';

    public $timestamps = false;

    protected $fillable = [ 'nome' ];

    public function usuario(){
        return $this->hasMany(User::class, 'niveis_acessos_id','id');
    }

}
