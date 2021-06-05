@extends('layout')

@section('title', 'Mi perfil')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="/categoria">Categorías</a></li>
            <li><a href="/productos">Productos</a></li>
            <li><form action="/search" method="get" role="search">
                <input type="text" name="find" placeholder="Buscar productos">
                <button type="submit">Buscar</button>
            </form></li>
        </ul>
    </div>
@endsection

@section('contenido')
    <div id="datosPersonales">
        <img src="{{ url('storage/'.$usuario->imagen) }}">
        <div>
            <p id="nombre">{{ $usuario->nombre }} {{ $usuario->a_paterno }} {{ $usuario->a_materno }}</p>
            <p>{{ $usuario->correo }}</p>
            <p>{{ $usuario->rol }}</p>
            <button id="botonInverso"><a href="/usuario/edit/{{ $usuario->usuarioID }}">Editar perfil</a></button>
        </div>
    </div>
    <a href="/salir"><button id="botonInverso" class="pafuera">Salir pa fuera</button></a>
@endsection