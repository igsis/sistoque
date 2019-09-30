<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');

Route::group(['prefix' => 'produto'], function(){

    Route::get('/cadastrar', 'ProdutoController@create')->name('produto.cadastro');

    Route::post('/categoria', 'CategoriaController@create')->name('createCategoria');

    Route::post('/gravarProduto', 'ProdutoController@store')->name('produto.gravar');
});

Route::get('/pedido', 'PedidoController@create')->name('pedido');

Route::get('/conta', 'UserController@edit')->name('minha_conta');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
