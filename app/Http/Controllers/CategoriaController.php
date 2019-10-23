<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cats = Categoria::where('publicado',1)->get();

        return view('categoria.index', compact('cats'));
    }
}
