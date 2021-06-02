<?php

use Illuminate\Support\Facades\Route;
use App\Models\Categoria;
use App\Models\Bitacora;
use App\Models\Usuario;

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

Route::get('/', function() {
    return view('login');
});

Route::get('login', function() {
    return view('login');
})->name('login');

Route::get('validar', 'AutenticarController@validar');
Route::get('salir', 'AutenticarController@salir');

Route::get('supervisor', function() {
    return view('supervisor');
})->middleware('auth');

Route::get('revisor' ,function() {
    return view('revisor');
});

Route::get('cliente', function() {
    $categorias = Categoria::all();
    $usuario = Auth::User();
    return view('cliente', compact('categorias', 'usuario'));
});

Route::get('registro', function() {
    return view('registro');
});

Route::get('bitacora', function() {
    $registros = Bitacora::all();
    return view('bitacora', compact('registros'));
});

// rutas transacciones
Route::get('transacciones', function() {
    return view('transacciones');
});
// rutas transacciones

// rutas propuestas
Route::get('propuestas', function() {
    return view('propuestas');
});
// rutas propuestas

Route::get('categorias', 'CategoriaController@index');
Route::get('categoria/create', 'CategoriaController@create');
Route::post('categoria/store', 'CategoriaController@store');
Route::get('categoria/edit/{categoria_id}', 'CategoriaController@edit');
Route::put('categoria/edit/{categoria_id}', 'CategoriaController@update');
Route::get('categoria/show/{categoria_id}', 'CategoriaController@show');
Route::delete('categoria/delete/{categoria_id}', 'CategoriaController@destroy');



Route::get('productos', 'ProductoController@index');
Route::get('producto/create', 'ProductoController@create');
Route::post('producto/store', 'ProductoController@store');
Route::get('producto/edit/{producto_id}', 'ProductoController@edit');
Route::put('producto/edit/{producto_id}', 'ProductoController@update');
Route::get('producto/show/{producto_id}', 'ProductoController@show');
Route::delete('producto/delete/{producto_id}', 'ProductoController@destroy');


Route::get('usuarios', 'UsuarioController@index');
Route::get('usuario/create', 'UsuarioController@create');
Route::post('usuario/store', 'UsuarioController@store');
Route::get('usuario/edit/{usuario_id}', 'UsuarioController@edit');
Route::put('usuario/edit/{usuario_id}', 'UsuarioController@update');
Route::get('usuario/show/{usuario_id}', 'UsuarioController@show');
Route::delete('usuario/delete/{usuario_id}', 'UsuarioController@destroy');

