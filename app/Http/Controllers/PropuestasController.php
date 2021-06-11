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
        
        $datos = $request->all();
        if (is_null($datos['razon']))
            return redirect()->back()->with('error', 'Por favor llene todos los campos.');
        
        Propuesta::where('productoID', $productoID)->update(['rechazado' => 1, 'razon' => $datos['razon']]);
        
        return redirect()->back();
    }
}