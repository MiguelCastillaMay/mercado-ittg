@extends('layout')

@section('title', $producto->nombre)

@php
    $usuarioAuth = Auth::User();
@endphp
<style>
    .preguntar > form > textarea {
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
            @if (is_null($usuarioAuth) or $usuarioAuth->rol == 'Cliente')
                <li><form action="/search" method="get" role="search">
                    <input type="text" name="find" placeholder="Buscar productos">
                    <button type="submit">Buscar</button>
                </form></li>
            @elseif ($usuarioAuth->rol == 'Supervisor' or $usuarioAuth->rol == 'Revisor')
                <li><a href="/productos">Bitácora</a></li>
            @endif
            @if (is_null($usuarioAuth))
                <li><a href="/login">Iniciar sesión</a></li>
            @elseif ($usuarioAuth->rol == 'Cliente')
                <li><a href="/usuario/show/{{ $usuarioAuth->usuarioID }}">Mi perfil</a></li>
            @endif
        </ul>
    </div>
@endsection
@section('contenido')
    @if (session('mensaje'))
        <h2>{{ session('mensaje') }}</h2>
    @endif
    <div class="catalogo">
        <div class="producto">
            <img src="{{ url('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}">
            <div class="datosProducto">
                <h1>{{ $producto->nombre }}</h1>
                <p>{{ $producto->descripcion }}</p>
                <p>Precio</p>
                <form action="/producto/agregar-carrito/{{ $producto->productoID }}" method="get">
                    <input type="number" name="cantidad" value="1" id="">
                    <button id="botonInverso" type="submit">Agregar al carrito</button>
                </form>
            </div>
        </div>
        <div class="preguntas">
            <div class="preguntar">
                @can('preguntar', $producto)
                    <h2>Haz una pregunta</h2>
                    <form action="" method="post">
                        <textarea name="pregunta" id="" cols="30" rows="10"></textarea>
                        <button type="submit" id="botonInverso">Preguntar</button>
                    </form>
                @else
                    <h2>Inicia sesión para hacer una pregunta.</h2>
                @endcan
            </div>
            @forelse ($preguntas as $pregunta)
                <p>{{ $pregunta->pregunta }}</p>
            @empty
                <h2>No hay preguntas sobre este producto. ¡Sé el primero!</h2>
            @endforelse
        </div>
    </div>
@endsection