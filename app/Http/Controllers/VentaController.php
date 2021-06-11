<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use Redirect;

class VentaController extends Controller
{
    public function rating($id, Request $request)
    {
       $rating = $request->input('Calificar');
       Venta::where('ventaID', $id)->update(['calificacion' => $rating]);
       return redirect()->back();

    }



}