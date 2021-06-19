@extends('layout')

@section('title', 'Supervisor')

<style>
    a.boton {
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
    
    a.boton:hover {
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
</style>

@section('navBar')
    <div class="menuBar">
        <h1>Mercado ITTG</h1>
    </div>
@endsection

@auth
    @section('contenido')
    <div id="opcionesSupervisor">
        <a href="/usuarios"><button id="botonInverso">Usuarios</button></a>
        <a href="/categoria"><button id="botonInverso">Categorías</button></a>
        <a href="/productos"><button id="botonInverso">Productos</button></a>
        <a href="/bitacora"><button id="botonInverso">Bitácora</button></a>
        <a href="/transacciones"><button id="botonInverso">Compras y ventas</button></a>
        <a href="/propuestas"><button id="botonInverso">Propuestas</button></a>
        <a href="/infoGeneral"><button id="botonInverso">Información General</button></a>
    </div>
    <a class="boton pafuera" href="/salir">Salir pa fuera</a>
    @endsection
@endauth
