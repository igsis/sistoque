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
Route::get('/', function () {
    return view('index');
})->middleware('auth')
->name('home');

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

//~~ Rotas de autenticação ~~
Auth::routes();

//Logout
Route::get('/logout', function (){
    Auth::logout();
    Session::flush();
    return redirect("/login");
})->name('logout');
//Fim autenticação
