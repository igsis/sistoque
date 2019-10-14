<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Puxa as categorias cadastradas
Route::get('/categorias', 'CategoriaController@indexJson')->name('api.listarCategorias');

//Puxa as subcategorias cadastradas baseada na categoria
Route::get('/subcategoria/{categoria}', 'SubcategoriaController@indexJson')->name('api.listarSubcategoria');

//Puxa as tipo de quantida
Route::get('/tipoQuantidade', 'TipoCategoriaController@indexJson')->name('api.listarTipoCategoria');


//Faz toda parte de crud de produtos
Route::resource('/produtos', 'ProdutoController');
