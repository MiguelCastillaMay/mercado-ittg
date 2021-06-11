<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Propuesta;
use Illuminate\Support\Facades\Auth;

class PropuestasController extends Controller{
    public function index() {
        $propuestas = Producto::where('activo', '=', 0)->get();
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

        return view('propuestas.rechazo', compact('propuesta'));
    }

    public function rechazo($productoID, Request $request) {
        $propuesta = new Propuesta();
        $datos = $request->all();
        if (is_null($datos['razon']))
        return redirect()->back()->with('error', 'Por favor llene todos los campos.');

        $propuesta->razon = $datos['razon'];
        $propuesta->rechazado=1;
        $propuesta->productoID=$productoID;
        $propuesta->save();

        return view('propuestas');
    }
}