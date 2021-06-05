<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $usuario = Auth::User();
        if (is_null($usuario) or $usuario->rol == 'Cliente') {
            $productos = Producto::Activos()->get();
            return view('welcome', compact('productos'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('productos.newProducto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $datos = $request->all();

        if (is_null($datos['nombre']) or is_null($datos['desc']) or is_null($datos['imagen']))
            return redirect()->back()->with('error', 'Por favor llene todos los campos.');            
        else {
            $producto = new Producto();
            $producto->nombre = $datos['nombre'];
            $producto->descripcion = $datos['desc'];
            $path = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $path;
            $producto->activo = 1;
            $producto->save();

            return redirect('/productos')->with('mensaje', 'Producto registrado correctamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $producto = Producto::find($id);
        return view('productos.mostrar', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $producto = Producto::find($id);
        return view('productos.editar', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Producto::destroy($id);
        return redirect('/productos')->with('alert','Producto eliminado');
    }

    public function productos_por_categoria($id) {
        $productos = Categoria::find($id)->productos;
        var_dump($productos);
    }
}
