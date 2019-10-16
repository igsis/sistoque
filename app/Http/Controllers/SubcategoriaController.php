<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subs =  Subcategoria::where('publicado',1)->get();

        return view('subcategoria.index',compact('subs'));
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
        $sub =  new Subcategoria();

        $sub->nome = $request->input('nome');
        $sub->categoria_produtos_id = $request->input('categoria');

        $sub->save();

        return json_encode($sub);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub = Subcategoria::find($id);

        if (isset($sub)){
            return json_encode($sub);
        }

        return response('Subcategoria não encontrada',404);
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
        $sub = Subcategoria::find($id);

        if (isset($sub)){
            $sub->nome = $request->input('nome');
            $sub->categoria_produtos_id = $request->input('categoria');

            $sub->save();

            return json_encode($sub);
        }

        return response('Subcategoria não encontrada',404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub = Subcategoria::find($id);

        if (isset($sub)){
            $sub->publicado = 0;
            $sub->save();
            return response("Apagado com sucesso",200);
        }

        return response("Não foi possivel apagar",404);

    }

    public function indexJson($cat){
        $sub = Subcategoria::where('categoria_produtos_id',$cat)->get();
        return json_encode($sub);
    }
}
