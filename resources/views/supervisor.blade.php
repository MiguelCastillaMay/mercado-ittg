@extends('layout')

@section('title', 'Admin')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        {{-- <ul>
            <li><a href="cliente.php">Menú</a></li>
            <li><a href="#">Categorías</a></li>
            <li><a href="#">Ofertas</a></li>
        </ul> --}}
    </div>
@endsection

@auth
@php
    $usuario = Auth::User()
@endphp
    @section('contenido')
    <div id="opcionesSupervisor">
        <a href="/usuarios"><button id="botonInverso">Usuarios</button></a>
        <a href="/categorias"><button id="botonInverso">Categorías</button></a>
        <a href="/productos"><button id="botonInverso">Productos</button></a>
        <a href="/bitacora"><button id="botonInverso">Bitácora</button></a>
        <a href="/transacciones"><button id="botonInverso">Compras y ventas</button></a>
        <a href="/propuestas"><button id="botonInverso">Propuestas</button></a>
    </div>
    <a href="/salir"><button id="botonInverso" class="pafuera">Salir pa fuera</button></a>
    @endsection
@endauth