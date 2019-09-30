<?php

namespace sitoque\Http\Controllers;

use Illuminate\Http\Request;
use sitoque\Models\Categoria;

class CategoriaController extends Controller
{
    public function create(Request $request)
    {
        $data = $this->validate($request, [
            'nome'=>'required|unique:categoria_produtos'
        ]);

        Categoria::create($data);

        return redirect()->back() ->with('flash_message','Categoria Inserida com sucesso');

    }
}
