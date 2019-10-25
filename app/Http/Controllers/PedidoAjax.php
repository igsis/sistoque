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

    public function edit($id)
    {

        $ped = Pedido::find($id);

        if (isset($ped)){
            return json_encode($ped);
        }

        return response ('Produto não encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $ped = Pedido::find($id);

        if(isset($ped)){

            $ped->produtos_id = $request->input('produto_id');
            $ped->usuarios_id = $request->input('usuario_id');
            $ped->quantidade = $request->input('quantidade');
            $ped->status_pedidos_id = 2;


            $ped->save();

            return json_encode($ped);
        }
    }

    public function destroy($id)
    {
        $ped = Pedido::find($id);

        if (isset($ped)){
            $ped->publicado = 0;
            $ped->save();

            return response('Apagado com sucesso',200);
        }

        return response('Pedido não encontrado', 404);

    }
}
