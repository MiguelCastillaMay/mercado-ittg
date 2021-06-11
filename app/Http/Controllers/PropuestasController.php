<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Propuesta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropuestasController extends Controller{
    public function index() {
        $propuestas = DB::select('SELECT propuestas.*, productos.*
        FROM propuestas 
        INNER JOIN productos 
        ON propuestas.productoID = productos.productoID WHERE productos.activo = 0 AND propuestas.rechazado = 0;');
        return view('propuestas', compact('propuestas'));
    }

    public function aceptar($productoID) {
        $producto = Producto::find($productoID);
        $producto->activo = 1;

        $producto->save();
        return redirect('/propuestas')->with('mensaje', 'Propuesta aceptada.');
    }

    public function rechazar($productoID) {
        $propuesta = Producto::find($productoID);

        return redirect('/propuestas')->with('mensaje', 'Propuesta aceptada.');
    }

    public function rechazo($productoID, Request $request) {
        $propuesta = Propuesta::find($productoID);
        $datos = $request->all();
        if (is_null($datos['razon']))
        return redirect()->back()->with('error', 'Por favor llene todos los campos.');

        $propuesta->razon = $datos['razon'];
        $propuesta->rechazado=1;
        $propuesta->productoID=$productoID;
        $propuesta->save();

        return view('propuestas');
    }
    
    /* 
    
    public function show($id) {
        $producto = Producto::find($id);
        $ventas = DetallesVenta::where('productoID', '=', $id)->get();
        $ventas = count($ventas);
        $preguntas = Pregunta::where('productoID', '=', $id)->get();
        return view('productos.mostrar', compact('producto', 'ventas', 'preguntas'));
    }

    
    public function edit($id) {
        $producto = Producto::find($id);
        return view('productos.editar', compact('producto'));
    }

    
    public function update(Request $request, $id) {
        $producto = Producto::find($id);
        $datos = $request->all();
        if (is_null($datos['nombre']) or is_null($datos['desc']))
            return redirect()->back()->with('error', 'Por favor llene todos los campos.');            

        $producto->nombre = $datos['nombre'];
        $producto->descripcion = $datos['desc'];
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $path;
        }
        $producto->activo = 1;
        $producto->save();

        return redirect('/productos')->with('mensaje', 'Producto actualizado correctamente.');
    }

    
    public function destroy($id) {
        Producto::destroy($id);
        return redirect('/productos')->with('alert','Producto eliminado');
    }

    public function productos_por_categoria($id) {
        $usuario = Auth::User();

        if (is_null($usuario) or $usuario->rol == 'Cliente') {
            $productos = Categoria::find($id)->productos->where('activo', '=', '1');
            return view('welcome', compact('productos'));
        } elseif ($usuario->rol == 'Supervisor' or $usuario->rol == 'Revisor') {
            $productos = Categoria::find($id)->productos;
            return view('welcome', compact('productos'));
        }
    }

    public function comprar($id) {
        $usuario = Auth::User();
        if (is_null($usuario)) {
            return redirect('login')->with('mensaje', 'Inicie sesión para comprar.');
        }
    }
    */
}