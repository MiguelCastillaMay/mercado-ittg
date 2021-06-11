<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Venta;
use App\Models\DetallesVenta;
use App\Models\Pregunta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('log')->only('index');
        // $this->middleware('subscribed')->except('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::User();
        if (is_null($usuario) or $usuario->rol == 'Cliente')
        {
            $productos = Producto::Activos()->get();
            return view('welcome', compact('productos'));
        }
        elseif ($usuario->rol == 'Supervisor' or $usuario->rol == 'Revisor')
        {
            $productos = Producto::all();
            return view('productos.tablero', compact('productos'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.newProducto');
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
        $usuarioID = Auth::User()->usuarioID;

        if (is_null($datos['nombre']) or is_null($datos['desc']) or is_null($datos['imagen']))
            return redirect()->back()->with('error', 'Por favor llene todos los campos.');            
        else {
            $path = $request->file('imagen')->store('productos', 'public');

            $productoID = DB::table('productos')->insertGetId([
                'nombre' => $datos['nombre'],
                'descripcion' => $datos['desc'],
                'precio' => $datos['precio'],
                'imagen' => $path,
                'activo' => 0,
                'categoriaID' => 1,
                'usuarioID' => $usuarioID
            ]);

            DB::table('propuestas')->insert([
                'rechazado' => 0,
                'productoID' => $productoID
            ]);

            return redirect('/productos')->with('mensaje', 'Producto registrado correctamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuarioAuth = Auth::User();
        $producto = Producto::find($id);
        $preguntas = DB::select('
        SELECT preguntas.pregunta, respuestas.respuesta, preguntas.created_at as pregunta_fecha, respuestas.created_at as respuesta_fecha
        FROM preguntas
        LEFT JOIN productos ON productos.productoID = preguntas.productoID
        LEFT JOIN respuestas ON preguntas.preguntaID = respuestas.preguntaID
        WHERE productos.productoID = ?', [$id]);

        if (is_null($usuarioAuth) or $usuarioAuth->rol == 'Cliente')
        {
            return view('productos.ver-producto', compact('producto', 'preguntas'));
        }
        elseif ($usuarioAuth->rol == 'Supervisor' or $usuarioAuth->rol == 'Revisor')
        {
            $ventas = DetallesVenta::where('productoID', '=', $id)->get();
            $ventas = count($ventas);

            return view('productos.mostrar', compact('producto', 'ventas', 'preguntas'));
        }
        // dd($preguntas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        return view('productos.editar', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        if ($producto->activo == 0){
            $datos = $request->all();

            if (is_null($datos['nombre']) or is_null($datos['desc']))
                return redirect()->back()->with('error', 'Por favor llene todos los campos.');            

            $producto->nombre = $datos['nombre'];
            $producto->descripcion = $datos['desc'];

            if ($request->hasFile('imagen'))
            {
                $path = $request->file('imagen')->store('productos', 'public');
                $producto->imagen = $path;
            }
            
            $usuario_id = Auth::User()->usuarioID;
            $producto->save();

            return redirect('/');
        } else
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        Producto::destroy($id);
        /*  
        if ($producto->activo == 0) {
            Producto::destroy($id);
            return redirect()->back();
        } else
            */return redirect()->back();
            
        
    }

    public function productos_por_categoria($id)
    {
        $usuario = Auth::User();

        if (is_null($usuario) or $usuario->rol == 'Cliente') {
            $productos = Categoria::find($id)->productos->where('activo', '=', '1');
            return view('welcome', compact('productos'));
        } elseif ($usuario->rol == 'Supervisor' or $usuario->rol == 'Revisor') {
            $productos = Categoria::find($id)->productos;
            return view('welcome', compact('productos'));
        }
    }

    public function comprar(Request $request, $id)
    {
        $usuario = Auth::User();
        if (is_null($usuario)) {
            return redirect('login')->with('mensaje', 'Inicie sesión para comprar.');
        } else {
            $cantidad = $request->input('cantidad');
            $precio = $request->input('precio');
            $total = $cantidad * $precio;
            $ventaID = DB::table('ventas')->insertGetId([
                'total' => $total, 
                'usuarioID' => $usuario->usuarioID
            ]);
            DB::table('detalles_ventas')->insert([
                'productoID' => $id,
                'compradorID' => $usuario->usuarioID,
                'ventaID' => $ventaID,
                'cantidad' => $cantidad,
                'precio' => $precio
            ]);
            return redirect()->back()->with('mensaje', 'Compra realizada!');
        }
    }

    public function misProductos($id)
    {
        if ($id == Auth::User()->usuarioID) {
            $productos = Producto::where('usuarioID', '=', $id)->where('activo', '=', 1)->get();

            return view('usuarios.mis-productos', compact('productos'));
        } else
            return redirect()->back();
    }
    
    

    public function misPropuestas($id) {
        if ($id == Auth::User()->usuarioID) {

            $propuestas = DB::select('
            SELECT productos.productoID, productos.nombre, productos.descripcion, productos.imagen, productos.precio, productos.activo, propuestas.rechazado, propuestas.razon
            FROM productos
            LEFT JOIN propuestas
            ON productos.productoID = propuestas.productoID
            WHERE productos.usuarioID = ?', [$id]);
            
            return view('usuarios.mis-propuestas', compact('propuestas'));
        } else
            return redirect()->back();
    }

    
    public function misCompras($usuarioID)
    {
        $compras = DB::select('
            SELECT productos.nombre, productos.descripcion, productos.imagen, productos.precio, 
                detalles_ventas.cantidad, ventas.total, ventas.fecha, ventas.ventaID
            FROM productos
            LEFT JOIN detalles_ventas
                ON productos.productoID = detalles_ventas.productoID
            LEFT JOIN ventas
                ON detalles_ventas.ventaID = ventas.ventaID
            WHERE detalles_ventas.compradorID = ?', [$usuarioID]
        );
        return view('usuarios.mis-compras', compact('compras'));
    }

    public function misVentas($usuarioID)
    {
        $ventas = DB::select('
            SELECT productos.nombre, productos.descripcion, productos.imagen, productos.precio, 
                detalles_ventas.cantidad, ventas.total, ventas.fecha
            FROM productos
            JOIN detalles_ventas
                ON productos.productoID = detalles_ventas.productoID
            JOIN ventas
                ON detalles_ventas.ventaID = ventas.ventaID
            WHERE productos.usuarioID = ?', [$usuarioID]
        );
        return view('usuarios.mis-ventas', compact('ventas'));
    }

    public function rating($usuarioID)
    {
      
        return view('usuarios.mis-ventas', compact('ventas'));
    }
}