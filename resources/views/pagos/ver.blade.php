@extends('layout')

@section('title', 'Pagos')

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
    a.opciones, input.opciones {
        font-weight: 100;
        font-size: 15px;
        display: inline;
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
    }
    form {
        display: inline;
        margin: 0px;
    }
    #botones {
        padding-top: 10px;
    }
    h2 {
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
        color: #1e212d;
        margin-top: -10.080px;
    }
    img {
        height: max-content;
    }
    .datosProducto > p {
        margin-bottom: 10px;
        margin-top: 0px;
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
    @if (session('mensaje'))
        <h2>{{ session('mensaje') }}</h2>
    @endif
        <div class="catalogo">
            @forelse ($pagos as $pago)
                    <div class="producto">
                        <img src="{{ $pago->evidencia }}">
                        <div class="datosProducto">
                            <h2>Detalles de la venta</h2>
                            <p>{{ $pago->nombre }}</p>
                            <p>Vendido por: {{ $pago->vendedor }}</p>
                            <p>Cantidad: {{ $pago->cantidad }}</p>
                            <p>Precio: ${{ $pago->precio }} MXN C/U</p>
                            <p>Total: {{ $pago->total }}</p>
                            <a class="boton" href="/pago/validar/{{ $pago->pagoID }}">Validar pago</a>
                        </div>
                    </div>
            @empty
            <h2>No hay pagos pendientes por validar.</h2>
            @endforelse
        </div>
    <a class="boton pafuera" href="/salir">Salir pa fuera</a>
@endsection