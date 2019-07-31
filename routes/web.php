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
//Productos
Route::get('{categoria}/{id}-{titulo}-{marca}-{modelo}','Producto\ProductoController@permalink');
Route::get('/','Producto\ProductoController@index');
Route::get('search','Producto\ProductoController@Buscar');

//categorias
Route::resource('categorias','Producto\CategoriaController');


//Direcciones
Route::post('venta/direccion','Venta\DireccionController@create')->name('direccion.create');
Route::post('cp','Venta\DireccionController@cp');
Route::post('venta/confirmacion','Venta\DireccionController@store');

//Ventas
Route::post('atencion_cliente','Venta\AtencionClienteController@contacto')->name('contacto');
Route::get('add_producto/{id}','Venta\VentaController@AddCarrito');
Route::get('quitar_carrito/{id}','Venta\VentaController@RmCarrito');
Route::post('convert_c','Venta\VentaController@ConvertC');
Route::get('contacto',function(){
	return view('Cliente.contacto');
});
Route::resource('ventas','Venta\VentaController');

//autenticacion
Auth::routes();



// Route::get('cargar_datos','Producto\ProductoController@CargarDatos');
// Route::get('cargar_productos','Producto\ProductoController@ActualizarProductos');
Route::get('cargar_categorias','Producto\CategoriaController@CargarCategorias');

Route::get('example','ExampleController@example');



Route::get('/home', 'HomeController@index')->name('home');
