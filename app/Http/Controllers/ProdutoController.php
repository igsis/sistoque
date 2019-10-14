<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prods = Produto::where('publicado','=',1)->get();

        return view('produto.index',compact('prods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prod = new Produto();

        $prod->nome = $request->nome;
        $prod->quantidade = $request->quantidade;
        $prod->nivel_emergencia = $request->nivel_emergencia;
        $prod->categoria_produtos_id = $request->categoria_produtos_id;
        $prod->subcategoria_produtos_id = $request->subcategoria_produtos_id;
        $prod->tipo_quantidades_id = $request->tipo_quantidade_id;

       $prod->save();

       return json_encode($prod);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod = Produto::find($id);
        if (isset($prod)){
            return json_encode($prod);
        }

        return response ('Produto não encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prod = Produto::find($id);
        if(isset($prod)){
            $prod->nome = $request->nome;
            $prod->quantidade = $request->quantidade;
            $prod->nivel_emergencia = $request->nivel_emergencia;
            $prod->categoria_produtos_id = $request->categoria_produtos_id;
            $prod->subcategoria_produtos_id = $request->subcategoria_produtos_id;
            $prod->tipo_quantidades_id = $request->tipo_quantidade_id;

            $prod->save();

            return json_encode($prod);
        }


        return response('Produto não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Produto::find($id);

        if (isset($prod)){
            $prod->publicado = 0;
            $prod->save();

            return response('Apagado', 200);
        }
        return  response('Produto não encontrado', 404);
    }
}
