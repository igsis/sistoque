<?php

namespace App\Http\Controllers;

use App\Models\TipoQuantidade;
use Illuminate\Http\Request;

class TipoCategoriaController extends Controller
{

    public function index(){
        $tipo = TipoQuantidade::all();

        return json_encode($tipo);
    }
}
