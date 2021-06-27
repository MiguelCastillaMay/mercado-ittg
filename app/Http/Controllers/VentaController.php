<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use App\Models\Pagos;
use Redirect;
use Storage;

class VentaController extends Controller
{
    public function rating($ventaID, Request $request)
    {
       $rating = $request->input('Calificar');
       Venta::where('ventaID', $ventaID)->update(['calificacion' => $rating]);
       return redirect()->back();
    }

    public function evidencia(Request $request, $ventaID)
    {
        if(is_null($request->file('evidencia'))) {
            return redirect()->back()->with('mensaje', 'Por favor, agregue una evidencia de pago.');
        } else {
            $path = $request->file('evidencia')->store('evidencia', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $url = Storage::disk('s3')->url($path);

            $pago = new Pagos();
            $pago->ventaID = $ventaID;
            $pago->evidencia = $url;
            $pago->aprobado = 0;
            $pago->entregado = 0;
            $pago->save();

            return redirect()->back()->with('mensaje', '¡Se ha enviado exitosamente la evidencia!');
        }
    }
}