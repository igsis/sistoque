<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use sitoque\Models\Subcategoria;
use function foo\func;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');

Route::group(['prefix' => 'Produto'], function(){

    Route::get('/Cadastrar', 'ProdutoController@create')->name('produto.cadastro');

    Route::get('/Categoria', 'CategoriaController@create')->name('createCategoria');

    Route::post('/GravarProduto', 'ProdutoController@store')->name('produto.gravar');

    Route::get('/Listar', 'ProdutoController@index')->name('produto.listar');

});

//    Route::get('getSubcategoria/{idCategoria}','ProdutoController@getSubcategoria'); Teste Ajax


Route::group(['prefix' => 'Pedido'], function(){

    Route::get('/Solicitar', 'PedidoController@create')->name('pedido.solicitar');

    Route::get('/', 'PedidoController@index')->name('pedidos');
});

Route::get('/conta', 'UserController@edit')->name('minha_conta');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
