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

Route::get('/', function () {
    return view('index');
});

//Rota de produtos
Route::get('/produtos', 'ProdutoController@index')->name('produtos');

//Rota de Categorias
Route::get('/categorias', 'CategoriaController@index')->name('categorias');

//Rota de Subcategorias
Route::get('/subcategorias', 'SubcategoriaController@index')->name('subcategoria');
