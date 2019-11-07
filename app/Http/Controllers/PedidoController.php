<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $peds = Pedido::where('publicado', 1)->get();

        $user = Auth::id();

        return view('pedidos.index', compact('peds', 'user'));
    }

    public function pedidoSolicitado()
    {
        $peds = Pedido::where('status_pedidos_id',2)->get();

        return view('pedidos.pedidosSolicitados',compact('peds'));

    }

    public function pedidoAprovado()
    {
        $peds = Pedido::where('status_pedidos_id',1)->get();

        return view('pedidos.pedidosAprovados',compact('peds'));

    }

}
