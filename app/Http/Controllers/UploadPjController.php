<?php

namespace sitoque\Http\Controllers;

use Illuminate\Http\Request;

use sitoque\Models\PessoaJuridica;
use sitoque\Models\ListaDocumentos;

class UploadPjController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaJuridica');
    }

    public function listar()
    {
        $docs = ListaDocumentos::all();
        foreach ($docs as $doc) {
           echo $doc->documento . "<br>";
        }
    }
}
