<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($productoID)
    {
        $producto = Producto::find($productoID);

        //tabla preguntas: pregunta
        //tabla respuestas: respuesta
        $preguntas = DB::select('
            SELECT preguntas.preguntaID, preguntas.pregunta, respuestas.respuesta, preguntas.created_at as pregunta_fecha, respuestas.created_at as respuesta_fecha
            FROM preguntas
            LEFT JOIN productos ON productos.productoID = preguntas.productoID
            LEFT JOIN respuestas ON preguntas.preguntaID = respuestas.preguntaID
            WHERE productos.productoID = ?', [$productoID]);

        return view('productos.preguntas', compact('producto', 'preguntas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $productoID)
    {
        $pregunta = new Pregunta();
        $pregunta->productoID = $productoID;
        $pregunta->compradorID = Auth::User()->usuarioID;
        $pregunta->pregunta = request()->input('pregunta');
        $pregunta->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function show(Pregunta $pregunta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function edit(Pregunta $pregunta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pregunta $pregunta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pregunta $pregunta)
    {
        //
    }
}
