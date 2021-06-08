@extends('layout')

@section('title', $producto->nombre)

@php
    $usuario = Auth::User();
@endphp
<style>
    .preguntas > form > textarea {
        resize: none;
    }
    h2 {
        color: #1e212d;
    }
    .preguntar {
        justify-items: center
    }
</style>

@section('navBar')
    <div class="menuBar">
        <h1>Mercado ITTG</h1>
        <ul>
            <li><a href="/categoria">Categorías</a></li>
            <li><a href="/productos">Productos</a></li>
            @if (is_null($usuario) or $usuario->rol == 'Cliente')
                <li><form action="/search" method="get" role="search">
                    <input type="text" name="find" placeholder="Buscar productos">
                    <button type="submit">Buscar</button>
                </form></li>
            @elseif ($usuario->rol == 'Supervisor' or $usuario->rol == 'Revisor')
                <li><a href="/productos">Bitácora</a></li>
            @endif
            @if (is_null($usuario))
                <li><a href="/login">Iniciar sesión</a></li>
            @elseif ($usuario->rol == 'Cliente')
                <li><a href="/usuario/show/{{ $usuario->usuarioID }}">Mi perfil</a></li>
            @endif
        </ul>
    </div>
@endsection
@section('contenido')
    <div class="catalogo">
        <div class="producto">
            <img src="{{ url('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}">
            <div class="datosProducto">
                <h1>{{ $producto->nombre }}</h1>
                <p>{{ $producto->descripcion }}</p>
                <p>Precio</p>
                <form action="producto/comprar/{{ $producto->productoID }}" method="get">
                    <input type="number" name="cantidad" id="">
                    <button id="botonInverso" type="submit">Comprar</button>
                </form>
            </div>
        </div>
        <div class="preguntas">
            <div class="preguntar">
                <h2>Haz una pregunta</h2>
                <form action="" method="post">
                    <textarea name="pregunta" id="" cols="30" rows="10"></textarea>
                    <button type="submit" id="botonInverso">Preguntar</button>
                </form>
            </div>
            @forelse ($preguntas as $pregunta)
                <p>{{ $pregunta->pregunta }}</p>
            @empty
                <h2>No hay preguntas sobre este producto. ¡Sé el primero!</h2>
            @endforelse
        </div>
    </div>
@endsection