<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoAjax extends Controller
{

    public function store(Request $request)
    {
        $ped = new Pedido();

        $zona = new \DateTimeZone('America/Sao_Paulo');
        $data = new \DateTime('now',$zona);

        $ped->produtos_id = $request->input('produto_id');
        $ped->usuarios_id = $request->input('usuario_id');
        $ped->quantidade = $request->input('quantidade');
        $ped->data_pedido = $data->format('Y-m-d');
        $ped->status_pedidos_id = 2;

        $ped->save();

        $ped->status_pedidos_id = $ped->status->status;

        return json_encode($ped);

        return response('Criado', 200);

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
