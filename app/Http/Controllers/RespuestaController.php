<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;

class RespuestaController extends Controller
{
    public function responder(Request $request, $preguntaID) {
        if (is_null($request->input('respuesta'))) {
            return redirect()->back();
        } else {
            $respuesta = new Respuesta();
            $respuesta->preguntaID = $preguntaID;
            $respuesta->respuesta = $request->input('respuesta');
            $respuesta->save();

            return redirect()->back();
        }
    }
}
