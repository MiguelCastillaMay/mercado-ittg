@extends('layout')

@section('title', 'Supervisor')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
    </div>
@endsection

@auth
    @section('contenido')
        <div id="opcionesSupervisor">
            <a href="/usuarios"><button id="botonInverso">Usuarios</button></a>
            <a href="/categoria"><button id="botonInverso">Categorías</button></a>
            <a href="/productos"><button id="botonInverso">Productos</button></a>
            <a href="/bitacora"><button id="botonInverso">Bitácora</button></a>
        </div>
        <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
    @endsection
@endauth
