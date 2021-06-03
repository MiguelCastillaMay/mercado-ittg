<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categorias = Categoria::all();
        return view('categorias.tablero', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('categorias.newCategoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $categoria = new Categoria();
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('desc');
        $categoria->imagen = "archivo.jpg";
        $categoria->activa = 1;
        $categoria->save();

        /*$categoria = $request->input('nombre');
        CategoriasModel::agregar($categoria);*/
        return redirect('/categoria')->with('mensaje', 'Categoría agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $categoria = Categoria::find($id);
        return view('categorias.mostrar', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $categoria = Categoria::find($id);
        return view('categorias.editar', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $categoria = Categoria::find($id);
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('desc');
        $categoria->imagen = 'archivo.jpg';
        $categoria->activa = 1;
        $categoria->save();

        /*$newCategoria = $request->input('nombre');
        CategoriasModel::editar($id, $newCategoria);*/
        return redirect('/categoria')->with('mensaje', 'Categoría modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Categoria::destroy($id);
        return redirect('/categoria')->with('mensaje', 'Categoría eliminada');
    }
}