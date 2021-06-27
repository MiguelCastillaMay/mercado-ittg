<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Storage;

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
    public function store(Request $request) 
    {
        $datos = $request->all();
        if (is_null($datos['nombre']) or is_null($datos['desc']) or !$request->hasFile('imagen')) {
            return redirect()->back()->with('error', 'Por favor llene todos los campos.');
        }
        $categoria = new Categoria();
        $categoria->nombre = $datos['nombre'];
        $categoria->descripcion = $datos['desc'];
        $path = $request->file('imagen')->store('categorias', 's3');
        Storage::disk('s3')->setVisibility($path, 'public');
        $url = Storage::disk('s3')->url($path);
        $categoria->imagen = $url;
        $categoria->activa = 1;
        $categoria->save();

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

        $datos = $request->all();

        if (is_null($datos['nombre']) or is_null($datos['desc'])) {
            return redirect()->back()->with('error', 'Por favor llene todos los campos.');
        }

        $categoria->nombre = $datos['nombre'];
        $categoria->descripcion = $datos['desc'];

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('fotos', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $url = Storage::disk('s3')->url($path);
            $categoria->imagen = $url;
        }
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