<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pagos;
use App\Models\Venta;
use App\Models\Producto;
use Redirect;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    public function index() {

        $pagos = DB::select('SELECT pagos.evidencia, pagos.pagoID, productos.nombre, productos.descripcion, productos.precio, detalles_ventas.cantidad, ventas.total, usuarios.nombre as vendedor 
        FROM productos
        JOIN detalles_ventas ON detalles_ventas.productoID = productos.productoID
        JOIN ventas ON ventas.ventaID = detalles_ventas.ventaID 
        JOIN pagos ON pagos.ventaID = ventas.ventaID 
        JOIN usuarios ON usuarios.usuarioID = productos.usuarioID 
        WHERE pagos.aprobado = ?', [0]);
        
        return view('pagos.ver', compact('pagos'));
    }

    public function validar($id) {
        $pago = Pagos::find($id);

        $pago->aprobado = "1";
        $pago->save();        

        return redirect()->back()->with('mensaje', 'Pago validado correctamente! :)');
    }
}
