<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Categoria::where('publicado',1)->get();

        return view('categoria.index', compact('cats'));
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
        $cat =  new Categoria();

        $cat->nome = $request->input('nome');
        $cat->save();

        if (isset($cat)){
            return json_encode($cat);
        }

        return response('Não foi possivel cadastrar Categoria', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat =  Categoria::find($id);

        if (isset($cat)){
            return json_encode($cat);
        }

        return response('Categoria não encontrada',404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $cat = Categoria::find($id);

        if (isset($cat)){
            $cat->nome = $request->input('nome');
            $cat->save();

            return json_encode($cat);

        }

        return response('Categoria não encontrada',404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Categoria::find($id);

        if (isset($cat)){
            $cat->publicado = 0;
            $cat->save();

            return response('Apagado', 200);
        }

        return response('Categoria não encontrada',404);
    }

    public function indexJson(){
        $cats = Categoria::where('publicado',1)->get();
        return json_encode($cats);
    }
}
