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
Route::get('{categoria}/{id}-{titulo}-{marca}-{modelo}','Producto\ProductoController@permalink');

Route::get('/', function () {
    return view('inicio');
});

Route::get('cargar_datos','Producto\ProductoController@CargarDatos');
Route::get('cargar_productos','Producto\ProductoController@CargarProductos');
Route::get('cargar_categorias','Producto\CategoriaController@CargarCategorias');

Route::get('search','Producto\ProductoController@Buscar');
Route::get('add_producto/{id}','Venta\VentaController@AddCarrito');
Route::get('quitar_carrito/{id}','Venta\VentaController@RmCarrito');
Route::get('convert_c/{id}','Venta\VentaController@ConvertC');

Route::resource('ventas','Venta\VentaController');
Route::resource('tienda','Producto\ProductoController');
Route::resource('categorias','Producto\CategoriaController');

Route::get('example','ExampleController@example');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
