@extends('layout')

@section('title', 'Contador')
<style>
    a.boton, input.boton {
        -webkit-appearance: button;
        -moz-appearance: button;
        appearance: button;
        background-color: #1e212d;
        border-style: solid;
        border-color: #1e212d;
        font-size: 25px;
        padding: 10px;
        border-radius: 15px;
        color: #f0f8ff;
        transition-duration: 0.4s;
        cursor: pointer;
        font-family: "Montserrat", sans-serif;
        margin-bottom: 10px;
        font-weight: 100;
    }
    
    a.boton:hover, input.boton:hover {
        background-color: #f0f8ff;
        color: #1e212d;
    }
    .pafuera {
        display: block;
        width: fit-content;
        margin-top: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    h2, p {
        color: #1e212d;
        
    }
    .head {
        display: flex;
        justify-content: space-between;
    }
    input {
        margin-top: -10.080px;
    }
    .pagos > p {
        color: #1e212d;
        font-size: 25px;
        font-weight: 500;
    }
    .nombre {
        display: flex;
    }
    .nombre > h2 {
        margin-bottom: 10.72px;
    }
    .nombre > p {
        margin-top: 21px;
        margin-left: 5px;
        font-size: 20px;
    }
</style>

@section('navBar')
    <div class="menuBar">
        <h1>Mercado ITTG</h1>
        <ul>
            <li><a href="/contador">Menú</a></li>
            <li><a href="/validar-pagos/0">Validar pagos</a></li>
            <li><a href="/entregar-pagos/1">Entregar pagos</a></li>
        </ul>
    </div>
@endsection

@section('contenido')
    <div class="catalogo" style="padding-top: 20px;">
        @foreach ($vendedores as $vendedor)
        @php
            $pendientes = count(DB::select('SELECT DISTINCT usuarios.nombre, usuarios.a_paterno, usuarios.a_materno, usuarios.usuarioID, pagos.pagoID, pagos.entregado   
                                    FROM usuarios
                                    JOIN productos ON productos.usuarioID = usuarios.usuarioID
                                    JOIN detalles_ventas ON detalles_ventas.productoID = productos.productoID
                                    JOIN ventas ON ventas.ventaID = detalles_ventas.ventaID
                                    JOIN pagos ON pagos.ventaID = ventas.ventaID
                                    WHERE pagos.aprobado = 1 AND pagos.entregado = 0 AND usuarios.usuarioID = ?', [$vendedor->usuarioID]));
        @endphp
            <div class="head">
                <div class="nombre">
                    <h2>{{ $vendedor->nombre }} {{ $vendedor->a_paterno }} {{ $vendedor->a_materno }}</h2>
                    @if ($pendientes > 0)
                            <p>- Pagos pendintes por entregar</p>
                        </div>
                        <a class="boton" href="/ver-pagos/{{ $vendedor->usuarioID }}">Entregar pagos</a>
                    @else
                            <p>- No hay pagos pendientes por entregar</p>
                        </div>
                        <a class="boton" href="/ver-pagos/{{ $vendedor->usuarioID }}">Ver pagos</a>
                    @endif
            </div>
        @endforeach
    </div>
    <a class="boton pafuera" href="/salir">Salir pa fuera</a>
@endsection