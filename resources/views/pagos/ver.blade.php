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
</style>

@section('navBar')
    <div class="menuBar">
        <h1>Mercado ITTG</h1>
    </div>
@endsection
    
@section('contenido')
    @if (session('mensaje'))
        {{ session('mensaje') }}
    @endif
    @isset($pagos)
        <div class="catalogo">
            @foreach ($pagos as $pago)
                @if ($pago->aprobado == 0)
                    <div class="producto">
                        {{-- <img src="{{ url('storage/'.$pago->evidencia) }}"> --}}
                        <div class="datosProducto">
                            <h1>Nombre del producto{{-- {{ $producto->nombre }}--}}</h1> 
                            <p>Descripción{{-- {{ $producto->descripcion }} --}}</p>
                            <p>$0.00{{-- {{ $producto->precio }} --}}MXN C/U</p> 
                            <a class="boton" href="/validarPago/{{ $pago->pagoID }}">Validar pago</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endisset
    <a class="boton pafuera" href="/salir">Salir pa fuera</a>
@endsection