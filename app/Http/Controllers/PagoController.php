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
        $pagos = Pagos::all();
        
        return view('pagos.ver', compact('pagos'));
    }

    public function validar($id) {
        $pago = Pagos::find($id);
        return view('pagos.validar-pago', compact('pago'));
    }

    public function validacion($id) {
        $pago = Pagos::find($id);
        //es broma pero si quieres no es broma
        //hice esta basura porque pues, no jodas, es solo un dato el que se cambia y no conozco mejores maneras
        //perdóname dios por ser tan horny
        $pago->pagoID = $pago->pagoID;
        $pago->ventaID = $pago->ventaID;
        $pago->evidencia = $pago->evidencia;
        $pago->aprobado = "1";
        $pago->entregado = $pago->entregado;

        $pago->save();        

        return view('contador');
    }
}
