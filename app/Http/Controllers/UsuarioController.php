<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Redirect;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $usuario = Auth::User();
        if (is_null($usuario)) {
            return redirect('/login')->with('mensaje', 'Registro completado correctamente. Ya puedes iniciar sesión :)');
        } elseif ($usuario->rol == 'Supervisor') {
            $usuarios = Usuario::all();
            return view('usuarios.tablero', compact('usuarios'));
        } elseif ($usuario->rol == 'Revisor') {
            $usuarios = Usuario::where('rol', '!=', 'Supervisor')->get();
            return view('usuarios.tablero', compact('usuarios'));
        } elseif ($usuario->rol == 'Cliente') {
            return view('usuarios.perfil', compact('usuario'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('usuarios.nuevo-usuario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $datos = $request->all();
        
        if ($datos['password'] != $datos['password2']) {
            return redirect()->back()->with('error', 'La contraseñas no son iguales.');
        } if (is_null($datos['nombre']) or is_null($datos['a_paterno']) or is_null($datos['a_materno']) or is_null($datos['correo']) or !$request->hasFile('imagen') or is_null($datos['password']) or is_null($datos['password2'])) {
            return redirect()->back()->with('error', 'Por favor llene todos los campos.');
        } else {
            if (!isset($datos['rol'])) {
                $datos['rol'] = 'Cliente';
            }
            $path = $request->file('imagen')->store('fotos', 'public');
            $datos['imagen'] = $path;
            $datos['password'] = Hash::make($datos['password']);
            $datos['activo'] = 1;
            $newUser = new Usuario();
            $newUser->fill($datos);
            $newUser->save();

            return redirect('/usuarios')->with('mensaje', 'Usuario registrado correctamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $usuario = Usuario::find($id);
        $ventas = Venta::where('usuarioID', '=', $id)->get();
        $productos = Producto::where('usuarioID', '=', $id)->get();
        $ventas = count($ventas);
        $productos = count($productos);
        $preguntas = DB::select('
            SELECT productos.nombre as producto, preguntas.pregunta, preguntas.created_at as pregunta_fecha, respuestas.respuesta, respuestas.created_at as respuesta_fecha
            FROM preguntas
            LEFT JOIN productos ON productos.productoID = preguntas.productoID
            LEFT JOIN respuestas ON preguntas.preguntaID = respuestas.preguntaID
            WHERE preguntas.compradorID = ?', [$id]);
        return view('usuarios.perfil',compact('usuario', 'ventas', 'productos', 'preguntas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $usuario = Usuario::find($id);
        return view('usuarios.editar', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $valores = $request->all();
        $usuario = Usuario::find($id);

        if ($valores['password'] != $valores['password2']) {
            return redirect()->back()->with('error', 'La contraseñas no son iguales.');
        }
        if (is_null($valores['password']) and is_null($valores['password2'])) {
            $valores['password'] = $usuario->password;
        }
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('fotos', 'public');
            $valores['imagen'] = $path;
        } else {
            $path = $usuario->imagen;
            $valores['imagen'] = $path;
        }
        $valores['activo'] = 1;
        $usuario->fill($valores);
        $usuario->save();

        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Usuario::destroy($id);
        return redirect('/usuarios')->with('mensaje', 'Usuario eliminado correctamente');
    }

    public function conteo(){
        $users = DB::table('usuarios')->get();
        $conteoUsuarios = count($users);
        $acciones = DB::table('bitacora')->get();
        $conteoAcciones = count($acciones);
        $products = DB::table('productos')->get();
        $conteoProductos = count($products);
        return view('infoGeneral', compact('conteoUsuarios', 'conteoAcciones','conteoProductos'));
    }
}
