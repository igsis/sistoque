<?php

namespace sitoque\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function create()
    {
        return view('pedido');
    }
}
