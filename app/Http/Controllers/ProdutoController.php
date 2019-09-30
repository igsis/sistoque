<?php

namespace sitoque\Http\Controllers;

use Illuminate\Http\Request;
use sitoque\Models\Categoria;
use sitoque\Models\Subcategoria;
use sitoque\Models\TipoQuantidade;

class ProdutoController extends Controller
{
    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();
        $subcategorias = Subcategoria::orderBy('sub_categoria')->get();
        $tipoQuantidades = TipoQuantidade::all();

        return view('produto.cadastro', compact('categorias', 'subcategorias', 'tipoQuantidades'));
    }

    public function store(Request $request)
    {
        dd('teste ok');
    }
}
