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
    public function index($opc) 
    {
        if ($opc == 0) {
            $pagos = DB::select('SELECT pagos.evidencia, pagos.pagoID, productos.nombre, productos.descripcion, productos.precio, detalles_ventas.cantidad, ventas.total, usuarios.nombre as vendedor 
            FROM productos
            JOIN detalles_ventas ON detalles_ventas.productoID = productos.productoID
            JOIN ventas ON ventas.ventaID = detalles_ventas.ventaID 
            JOIN pagos ON pagos.ventaID = ventas.ventaID 
            JOIN usuarios ON usuarios.usuarioID = productos.usuarioID 
            WHERE pagos.aprobado = ?', [0]);

            return view('pagos.ver', compact('pagos'));
        } elseif ($opc == 1) {
            $pagos = DB::select('SELECT pagos.evidencia, pagos.entregado, pagos.pagoID, 
            productos.nombre, productos.descripcion, productos.precio, 
            detalles_ventas.cantidad, ventas.total, usuarios.usuarioID, usuarios.nombre as vendedor 
            FROM productos
            JOIN detalles_ventas ON detalles_ventas.productoID = productos.productoID
            JOIN ventas ON ventas.ventaID = detalles_ventas.ventaID 
            JOIN pagos ON pagos.ventaID = ventas.ventaID 
            JOIN usuarios ON usuarios.usuarioID = productos.usuarioID 
            WHERE pagos.aprobado = ?', [1]);

            return view('pagos.entregar', compact('pagos'));
        }
        
        
        
    }

    public function validar($id) 
    {
        $pago = Pagos::find($id);

        $pago->aprobado = "1";
        $pago->save();        

        return redirect()->back()->with('mensaje', 'Pago validado correctamente! :)');
    }

    public function entregar($usuarioID) 
    {
        DB::update('UPDATE pagos
                    JOIN ventas ON ventas.ventaID = pagos.ventaID
                    JOIN detalles_ventas ON detalles_ventas.ventaID = ventas.ventaID
                    JOIN productos ON productos.productoID = detalles_ventas.productoID
                    JOIN usuarios ON usuarios.usuarioID = productos.usuarioID 
                    SET pagos.entregado = 1 
                    WHERE usuarios.usuarioID = ?', [$usuarioID]);
        
        return redirect()->back()->with('mensaje', 'Pago entregado correctamente :)');
    }
}
