<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Rota da home
Route::get('/', 'HomeController@index')->name('home');

//~~ Rota de produtos ~~
Route::get('/produtos', 'ProdutoController@index')->name('produtos');
//Fim Produtos

//~~ Rota de Categorias ~~
Route::get('/categorias', 'CategoriaController@index')->name('categorias');
//Fim Categorias

//~~ Rota de Subcategorias ~~
Route::get('/subcategorias', 'SubcategoriaController@index')->name('subcategoria');
//Fim Subcategorias

//~~ Rota de Pedidos ~~
Route::get('/pedidos', 'PedidoController@index')->name('pedidos');
//Fim Pedidos

//~~ Rota de Pedidos solicitados ~~
Route::get('/pedidosSolicitados','PedidoController@pedidoSolicitado')->name('pedidoSolicitado');
//Fim Pedidos solicitados

//~~ Rota de Pedidos solicitados ~~
Route::get('/pedidosAprovadas','PedidoController@pedidoAprovado')->name('pedidoAprovado');
//Fim Pedidos solicitados

//~~ Rotas de autenticação ~~
Auth::routes();

//Logout
Route::get('/logout', 'HomeController@logout')->name('logout');
//Fim autenticação
