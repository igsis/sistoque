<?php

namespace sitoque\Http\Controllers;

use Illuminate\Http\Request;
use sitoque\Models\Categoria;
use sitoque\Models\Produto;
use sitoque\Models\Subcategoria;
use sitoque\Models\TipoQuantidade;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produto.listar', compact('produtos'));
    }
    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();
        $subcategorias = Subcategoria::orderBy('sub_categoria')->get();
        $tipoQuantidades = TipoQuantidade::all();

        return view('produto.cadastro', compact('categorias', 'subcategorias', 'tipoQuantidades'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required',
            'categoria' => 'required',
            'subcategoria' => 'required',
            'quantidade' => 'required',
            'tipoQuantidade' => 'required',
            'nivelEmergencia' => 'required'
        ]);

        $produtos = new Produto();
        $produtos->descricao = $request->descricao;
        $produtos->categoria_produtos_id = $request->categoria;
        $produtos->subcategoria_produtos_id = $request->subcategoria;
        $produtos->quantidade = $request->quantidade;
        $produtos->tipo_quantidades_id = $request->tipoQuantidade;
        $produtos->nivel_emergencia = $request->nivelEmergencia;
        $produtos->save();

        return redirect()->back() ->with('flash_message','Inserido com sucesso');
    }
}
