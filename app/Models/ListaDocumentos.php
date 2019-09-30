<?php

namespace sitoque\Models;

use Illuminate\Database\Eloquent\Model;

class ListaDocumentos extends Model
{
    protected $primaryKey = 'idListaDocumento';

    public $timestamps = false;

    protected $fillable = [
        'idListaDocumento', 
        'idTipoUpload', 
        'documento', 
        'sigla', 
        'publicado'
    ];
    
}