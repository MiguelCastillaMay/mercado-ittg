@extends('layout')

@section('title', 'Ver perfil')

@php
    $usuarioAuth = Auth::User()
@endphp

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
        <h1>TiendaFicticia.com</h1>
        <ul>
            @if ($usuarioAuth->rol == 'Supervisor' or $usuarioAuth->rol == 'Revisor')
                <li><a href="/supervisor">Menú</a></li>
            @endif
            <li><a href="/categoria">Categorias</a></li>
            <li><a href="/productos">Productos</a></li>
            @if ($usuarioAuth->rol == 'Cliente')
                <li><form action="/search" method="get" role="search">
                    <input type="text" name="find" placeholder="Buscar productos">
                    <button type="submit">Buscar</button>
                </form></li>
            @elseif ($usuarioAuth->rol == 'Supervisor' or $usuarioAuth->rol == 'Revisor')
                <li><a href="/categoria">Categorías</a></li>
                <li><a href="/bitacora">Bitácora</a></li>
            @endif
        </ul>
    </div>
@endsection

@section('contenido')
    @if ($usuarioAuth->rol == 'Cliente')
        <div id="datosPersonales">
            <img src="{{ url('storage/'.$usuario->imagen) }}">
            <div>
                <p id="nombre">{{ $usuario->nombre }} {{ $usuario->a_paterno }} {{ $usuario->a_materno }}</p>
                <p>{{ $usuario->correo }}</p>
                <p>{{ $usuario->rol }}</p>
                <a class="boton" href="/usuario/edit/{{ $usuario->usuarioID }}">Editar perfil</a>
                <a class="boton" href="/productos/usuario/{{ $usuario->usuarioID }}">Ver mis productos</a>
                <a class="boton" href="/producto/create">Agregar un producto</a>
                <a class="boton" href="/usuario/{{ $usuario->usuarioID }}/compras" class="boton">Mis compras</a>
                <a class="boton" href="/usuario/{{ $usuario->usuarioID }}/ventas" class="boton">Mis ventas</a>
            </div>
        </div>
    @elseif ($usuarioAuth->rol == 'Supervisor')
    <div id="datosPersonales">
        <img src="{{ url('storage/'.$usuario->imagen) }}">
        <div>
            <p id="nombre">{{ $usuario->nombre }} {{ $usuario->a_paterno }} {{ $usuario->a_materno }}</p>
            <p>{{ $usuario->rol }}</p>
            <p>{{ $usuario->correo }}</p>
            <p>Fecha de registro: {{ $usuario->created_at }}</p>
            <p>Ventas totales: {{ $ventas }}</p>
            <p>Productos en venta: {{ $productos }}</p>
            <a href="/usuario/edit/{{ $usuario->usuarioID }}">Editar perfil</a>
        </div>
    </div>
    @endif
    <a href="/salir" class="boton pafuera">Salir pa fuera</a>
@endsection