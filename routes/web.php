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
    return view('welcome');
});

Route::get('cargar_datos','Producto\ProductoController@CargarDatos');
Route::get('cargar_productos','Producto\ProductoController@CargarProductos');
Route::get('cargar_categorias','Producto\CategoriaController@CargarCategorias');

Route::resource('tienda','Producto\ProductoController');
Route::resource('categorias','Producto\CategoriaController');
