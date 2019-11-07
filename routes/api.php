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

Route::get('/statusPedido', function () {
    $status = \App\Models\Status::all();

    return json_encode($status);
})->name('status');

Route::put('/statusPedidos', function (Request $request, $id) {

    $ped = \App\Models\Pedido::find($id);

    if (isset($ped)){
        $ped->status_pedidos_id = $request->stat;
        $ped->observacao = $request->observacao;

        $ped->save();

        return response("Pedido aprovado com sucesso");
    }

    return response('Pedido não encontrado',404);
});

Route::put('/entregaPedido', function ($id){

    $ped = \App\Models\Pedido::find($id);

    if (isset($ped)){
        $ped->status_pedidos_id = 4;

        $ped->save();

        return response("Status alterado com sucesso");
    }

    return response('Pedido não encontrado',404);

});


Route::resource('/pedidos', 'PedidoAjax');


