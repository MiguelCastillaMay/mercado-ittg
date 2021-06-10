<?php

use Illuminate\Support\Facades\Route;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Bitacora;
use App\Models\Usuario;
use Illuminate\Http\Request;

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
    $productos = Producto::Activos()->get();
    return view('welcome', compact('productos'));
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

//
Route::get('transacciones', function() {
    return view('transacciones');
});

Route::resource('categoria', 'CategoriaController');

Route::get('productos', 'ProductoController@index');
Route::get('producto/create', 'ProductoController@create');
Route::post('producto/store', 'ProductoController@store');
Route::get('producto/edit/{producto_id}', 'ProductoController@edit');
Route::put('producto/edit/{producto_id}', 'ProductoController@update');
Route::get('producto/{producto_id}', 'ProductoController@show');
Route::delete('producto/delete/{producto_id}', 'ProductoController@destroy');

Route::get('productos/categoria/{categoria_id}', 'ProductoController@productos_por_categoria');
Route::get('producto/agregar-carrito/{producto_id}', 'ProductoController@agregarCarrito');
Route::get('productos/usuario/{usuario_id}', 'ProductoController@misProductos');
Route::get('mi-producto/{producto_id}', 'ProductoController@producto');

Route::get('propuestas', 'PropuestasController@index');
Route::get('propuesta/create', 'PropuestasController@create');
Route::post('propuesta/store', 'PropuestasController@store');
Route::get('propuesta/aceptar/{producto_id}', 'PropuestasController@aceptar');
Route::get('propuesta/rechazar/{producto_id}', 'PropuestasController@rechazar');
Route::put('propuesta/rechazar/{producto_id}', 'PropuestasController@rechazo');


Route::get('usuarios', 'UsuarioController@index');
Route::get('usuario/create', 'UsuarioController@create');
Route::post('usuario/store', 'UsuarioController@store');
Route::get('usuario/edit/{usuario_id}', 'UsuarioController@edit');
Route::put('usuario/edit/{usuario_id}', 'UsuarioController@update');
Route::get('usuario/show/{usuario_id}', 'UsuarioController@show');
Route::delete('usuario/delete/{usuario_id}', 'UsuarioController@destroy');

Route::get('infoGeneral','UsuarioController@conteo');

Route::get('search', function(Request $request) {
    $find = $request->input('find');
    $productos = Producto::Buscar($find)->get();
    if(count($productos) > 0)
        return view('welcome', compact('productos'));
    else return redirect()->back()->with('mensaje', 'No se encontraron resultados para tu búsqueda. Intenta con otro término.');
});

Route::get('categorias/guest', 'InvitadoController@categorias');

Route::get('preguntas/{producto_id}', 'PreguntaController@index');
Route::post('pregunta/{producto_id}', 'PreguntaController@store');

Route::post('responder/{pregunta_id}', 'RespuestaController@responder');
