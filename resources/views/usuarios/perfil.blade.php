@extends('layout')

@section('title', 'Mi perfil')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="#">Menú</a></li>
            <li><a href="#">Categorías</a></li>
            <li><a href="#">Ofertas</a></li>
            <li><a href="#">Mi perfil</a></li>
            <li><a href="#">Mi carrito</a></li>
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
            <button id="botonInverso"><a href="/usuario/edit/{{ $usuario->id }}">Editar perfil</a></button>
        </div>
    </div>
    <a href="/login"><button id="botonInverso" class="pafuera">Salir pa fuera</button></a>
@endsection