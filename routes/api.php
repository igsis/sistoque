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


//Puxa as tipo de quantida
Route::get('/tipoQuantidade', 'TipoCategoriaController@index')->name('api.listarTipoCategoria');


//Faz toda parte de crud de produtos
Route::resource('/produtos', 'ProdutoAjax');


//Faz parte de crud de categorias
Route::group(['prefix' => 'categorias'], function () {

    //Puxa as categorias cadastradas
    Route::get('/', 'CategoriaAjax@index')->name('api.listarCategorias');

    Route::post('/', "CategoriaAjax@store")->name('api.cadatroCategoria');
    Route::delete('/{id}', 'CategoriaAjax@destroy')->name('api.deletarCategoria');
    Route::get('/{id}', 'CategoriaAjax@show')->name('api.editarCategoria');
    Route::put('/{id}', 'CategoriaAjax@update')->name('api.editarCategoria');


});

Route::group(['prefix' => 'subcategorias'], function () {

    //Puxa as subcategorias cadastradas baseada na categoria
    Route::get('/{categoria}', 'SubcategoriaAjax@index')->name('api.listarSubcategoria');

    Route::post('/', "SubcategoriaAjax@store")->name('api.cadatroSubcategoria');
    Route::delete('/{id}', 'SubcategoriaAjax@destroy')->name('api.deletarSubcategoria');
    Route::get('/{id}', 'SubcategoriaAjax@show')->name('api.editarSubcategoria');
    Route::put('/{id}', 'SubcategoriaAjax@update')->name('api.editarSubcategoria');


});

