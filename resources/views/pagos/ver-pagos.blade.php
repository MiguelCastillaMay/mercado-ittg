@extends('layout')

@section('title', 'Entregar pagos')
    
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
    .head {
        color: #1e212d;
        display: flex;
        justify-content: space-between;
    }
    .pago > p {
        color: #1e212d;
        font-size: 25px;
        font-weight: 500;
        margin-bottom: 10px;
    }
    .detalles > p {
        color: #1e212d;
        font-size: 18px;
        margin: 0px;
    }
    h2 {
        color: #1e212d;
        display: flex;
        justify-content: center;
        margin-top: -10.080px;
    }
    span {
        font-weight: 300;
    }
    
    .head > p {
        font-size: 25px;
        font-weight: 300;
        margin-top: 18px;
    }
    .head > h2 {
        margin-top: 19.920px;
    }
    .detalles {
        display: flex;
        justify-content: space-around;
    }
</style>

@php
    $pendientes = count(DB::select('
    SELECT DISTINCT usuarios.nombre, usuarios.a_paterno, usuarios.a_materno, usuarios.usuarioID, pagos.pagoID, pagos.entregado   
    FROM usuarios
    JOIN productos ON productos.usuarioID = usuarios.usuarioID
    JOIN detalles_ventas ON detalles_ventas.productoID = productos.productoID
    JOIN ventas ON ventas.ventaID = detalles_ventas.ventaID
    JOIN pagos ON pagos.ventaID = ventas.ventaID
    WHERE pagos.aprobado = 1 AND pagos.entregado = 0 AND usuarios.usuarioID = ?', [$vendedor->usuarioID]));
@endphp

@section('contenido')
@if (session('mensaje'))
    <h2>{{ session('mensaje') }}</h2>
@endif
    <div class="catalogo">
        <form action="/entregar-pagos/{{ $vendedor->usuarioID }}" method="POST">
            @method('PUT')
            @csrf
            <div class="head">
                <h2>{{ $vendedor->nombre }} {{ $vendedor->a_paterno }} {{ $vendedor->a_materno }}</h2>
                @if ($pendientes > 0)
                    <input class="boton" type="submit" value="Entregar pagos">
                @else
                    <p>Sin pagos por entregar.</p>
                @endif
            </div>
            @foreach ($pagos as $pago)
                <div class="pago">
                    @if ($pago->entregado == 0)
                        <p>{{ $pago->nombre }}<span> - Pendiente</span></p>
                    @elseif ($pago->entregado == 1)
                        <p>{{ $pago->nombre }}<span> - Entregado</span></p>
                    @endif
                    <div class="detalles">
                        <p>Cantidad: {{ $pago->cantidad }}</p>
                        <p>Precio unitario: {{ $pago->precio }}</p>
                        <p>Total: {{ $pago->total }}</p>
                        <p>Fecha de compra: {{ $pago->fecha }}</p>
                    </div>
                </div>            
            @endforeach
        </form>
    </div>
    <a class="boton pafuera" href="/salir">Salir pa fuera</a>
@endsection