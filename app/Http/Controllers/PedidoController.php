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

    public function index(){
        $peds = Pedido::where('publicado',1)->get();

        $user =  Auth::id();

        return view('pedidos.index',compact('peds','user'));
    }




}
