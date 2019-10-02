<?php

namespace sitoque\Http\Controllers;

use Illuminate\Http\Request;
use sitoque\Models\Pedido;

class PedidoController extends Controller
{
    public function create()
    {
        return view('solicitar_pedido');
    }

    public function index()
    {
        $pedidos = Pedido::all();

        return view('pedidos', compact('pedidos'));
    }
}
