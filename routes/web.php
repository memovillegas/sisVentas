<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('auth/login');
// });
//Para eso el una ruta de tipo resource
//Hacer un grupo de rutas de recursos con peticion
//index, edit,show,create
Route::resource('almacen/categoria','CategoriaController');
// Route::resource('almacen/articulo','ArticuloController');]
Route::resource('almacen/producto','ProductoController');
Route::resource('acceso/empleado','EmpleadoController');
Route::resource('compras/proveedor','ProveedorController');
// Route::resource('compras/ingreso','PedidoProductoController');
Route::resource('compras/pedidos','PedidoProductoController');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );


// Auth::routes();
// Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
