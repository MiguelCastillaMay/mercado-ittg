<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pagos;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Usuario;
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
            $vendedores = DB::select('SELECT DISTINCT usuarios.nombre, usuarios.a_paterno, usuarios.a_materno, usuarios.usuarioID   
                                    FROM usuarios
                                    JOIN productos ON productos.usuarioID = usuarios.usuarioID
                                    JOIN detalles_ventas ON detalles_ventas.productoID = productos.productoID
                                    JOIN ventas ON ventas.ventaID = detalles_ventas.ventaID
                                    JOIN pagos ON pagos.ventaID = ventas.ventaID
                                    WHERE pagos.aprobado = 1');

            return view('pagos.entregar', compact('vendedores'));
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
        
        return redirect()->back()->with('mensaje', 'Pagos entregados correctamente :)');
    }

    public function verPagos($usuarioID) 
    {
        $vendedor = Usuario::find($usuarioID);

        $pagos = DB::select('SELECT pagos.evidencia, pagos.entregado, pagos.pagoID, 
            productos.nombre, productos.descripcion, productos.precio, 
            detalles_ventas.cantidad, ventas.total, ventas.fecha, usuarios.usuarioID, usuarios.nombre as vendedor 
            FROM productos 
            JOIN detalles_ventas ON detalles_ventas.productoID = productos.productoID
            JOIN ventas ON ventas.ventaID = detalles_ventas.ventaID 
            JOIN pagos ON pagos.ventaID = ventas.ventaID 
            JOIN usuarios ON usuarios.usuarioID = productos.usuarioID 
            WHERE pagos.aprobado = 1 AND usuarios.usuarioID = ? 
            ORDER BY pagos.entregado ASC', [$usuarioID]);

            return view('pagos.ver-pagos', compact('pagos', 'vendedor'));
    }
}
