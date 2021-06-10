<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($productoID)
    {
        $preguntas = Pregunta::where('productoID', '=', $productoID)->get();

        //tabla productos: nombre, descripcion, precio, imagen
        //tabla preguntas: pregunta
        //tabla respuestas: respuesta
        $info = DB::table('productos')
                    ->join('preguntas', 'productos.productoID', '=', 'preguntas.productoID')
                    ->join('respuestas', 'preguntas.preguntaID', '=', 'respuestas.preguntaID')
                    ->select('productos.nombre', 'productos.descripcion', 'productos.precio', 'productos.imagen', 'preguntas.pregunta', 'preguntas.created_at', 'respuestas.respuesta')
                    ->get();

        return view('productos.preguntas', compact('preguntas'));
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

        return redirect()->route('producto', [$producto]);

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
