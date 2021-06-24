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
    h2 {
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
    <div class="catalogo">
        @forelse ($pagos as $pago)
            <form action="/entregar-pagos/{{ $pago->usuarioID }}" method="POST">
                @method('PUT')
                @csrf
                <div class="head">
                    <h2>{{ $pago->vendedor }}</h2>
                    <input class="boton" type="submit" value="Entregar pagos">
                </div>
                <div class="pagos">
                    @if ($pago->entregado == 0)
                        <p>{{ $pago->nombre }} - Pendiente</p>
                    @elseif ($pago->entregado == 1)
                    <p>{{ $pago->nombre }} - Entregado</p>
                    @endif
                </div>
            </form>
        @empty
            <h2>Oh oh, no hay pagos.</h2>
        @endforelse
    </div>
    <a class="boton pafuera" href="/salir">Salir pa fuera</a>
@endsection