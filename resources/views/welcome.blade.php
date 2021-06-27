@extends('layout')

@section('title', 'Mercado ITTG')

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
    img {
        height: 250px;
        width: 250px;
        object-fit: cover;
        display: block;
        margin-bottom: 10px;
        border-radius: 10px;
    } 
    h2 {
        color: #1e212d;
        font-weight: 500;
        margin-top: 10px;
        margin-bottom: 10px;
        font-size: 30px;
    }
    h2.mensaje {
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
    }
    p {
        margin-top: 15px;
        margin-bottom: 15px;
    }
</style>

@php
    $usuario = Auth::User();
@endphp

@section('navBar')
    <div class="menuBar">
        <h1>Mercado ITTG</h1>
        <ul>
            @if (is_null($usuario) or $usuario->rol == 'Cliente')
                <li><a href="/categoria">Categorías</a></li>
                <li><a href="/productos">Productos</a></li>
                <li><form action="/search" method="get" role="search">
                    <input type="text" name="find" placeholder="Buscar productos">
                    <input  type="submit" value="Buscar" id="botonInverso">
                </form></li>
                @if (is_null($usuario))
                    <li><a href="/login">Iniciar sesión</a></li>
                @elseif ($usuario->rol == 'Cliente')
                    <li><a href="/usuario/show/{{ $usuario->usuarioID }}">Mi perfil</a></li>
                @endif
            @elseif($usuario->rol == 'Supervisor' or $usuario->rol == 'Revisor')
                <li><a href="/supervisor">Menú</a></li>
                <li><a href="/categoria">Categorías</a></li>
                <li><a href="/productos">Productos</a></li>
                <li><a href="/propuestas">Propuestas</a></li>
                <li><a href="/usuarios">Usuarios</a></li>
                <li><a href="/productos">Bitácora</a></li>
            @endif
        </ul>
    </div>
@endsection
    
@section('contenido')
    @if (session('mensaje'))
        <h2 class="mensaje">{{ session('mensaje') }}</h2>
    @endif
    @if (is_null($usuario) or $usuario->rol == 'Cliente')
        <div class="catalogo">
            @forelse ($productos as $producto)
                <div class="producto">
                    <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                    <div class="datosProducto">
                        <h2>{{ $producto->nombre }}</h2>
                        <p>{{ $producto->descripcion }}</p>
                        <p>${{ $producto->precio }} MXN C/U</p>
                        <a class="boton" href="/producto/{{ $producto->productoID }}">Ver producto</a>
                    </div>
                </div>
            @empty
                <h2 class="mensaje">Oh oh, no hay productos :(</h2>
            @endforelse
        </div>
    @elseif ($usuario->rol == 'Supervisor' or $usuario->rol == 'revisor')
    <div class="catalogo">
        @forelse ($productos as $producto)
            <div class="producto">
                <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                <div class="datosProducto">
                    <h2>{{ $producto->nombre }}</h2>
                    <p>{{ $producto->descripcion }}</p>
                    <p>${{ $producto->precio }} MXN C/U</p>
                    <a class="boton" href="/producto/{{ $producto->productoID }}">Ver producto</a>
                </div>
            </div>
        @empty
            <h2 class="mensaje">Oh oh, no hay productos :(</h2>
        @endforelse
    </div>
    @endif
    
    @if ($usuario)
        <a class="boton pafuera" href="/salir">Salir pa fuera</a>
    @endif
@endsection