<?php

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');

Route::group(['prefix' => 'produto'], function(){
    Route::get('/cadastro', 'ProdutoController@create')->name('produto.cadastro');
});

Route::get('/pedido', 'PedidoController@create')->name('pedido');

Route::get('/conta', 'UserController@edit')->name('minha_conta');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
