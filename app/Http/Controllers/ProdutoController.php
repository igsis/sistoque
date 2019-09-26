<?php

namespace ccult\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function create()
    {
        return view('produto.cadastro');
    }
}
