@extends('layout')

@section('title', 'Ver perfil')

@php
    $usuarioAuth = Auth::User()
@endphp

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            @if ($usuarioAuth->rol == 'Supervisor' or $usuarioAuth->rol == 'Revisor')
                <li><a href="/supervisor">Menú</a></li>
            @endif
            <li><a href="/usuarios">Usuarios</a></li>
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
                <button id="botonInverso"><a href="/usuario/edit/{{ $usuario->usuarioID }}">Editar perfil</a></button>
                <button id="botonInverso"><a href="/producto/create">Agregar un producto</a></button>
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
            <button id="botonInverso"><a href="/usuario/edit/{{ $usuario->usuarioID }}">Editar perfil</a></button>
        </div>
    </div>
    @endif
    <a href="/salir"><button id="botonInverso" class="pafuera">Salir pa fuera</button></a>
@endsection