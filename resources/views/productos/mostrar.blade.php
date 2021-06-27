@extends('layout')

@section('title', 'Detalles de producto')

@php
    $usuario = Auth::User()
@endphp
    
@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
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

<style>
    h2, h3, p {
        color: #1e212d;
    }
    h1.titulo {
        color: #1e212d;
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
    }
    .preguntas > h1 {
        color: #1e212d;
        display: flex;
        justify-content: center;
        margin-top: 10px;
        margin-bottom: 10px;
        font-size: 30px;
    }
    span {
        font-weight: 300;
    }
    h2 {
        font-weight: 500;
    }
    .pregunta {
        display: flex;
    }
    .pregunta > p {
        margin-top: 21px;
        margin-left: 5px;
        margin-bottom: 8px;
    }
    .pregunta > h3 {
        margin-bottom: 10.72px;
    }
    .respuesta > p {
        margin-top: 0px;
    }
    img {
        height: 200px;
        display: block;
        margin-bottom: 10px;
        border-radius: 10px;
    }
    </style>

@section('contenido')
    <div class="catalogo" style="padding-bottom: 40px;">
        <h1 class="titulo">
            {{ $producto->nombre }}
        </h1>
        <div class="producto">
            <img src="{{ $producto->imagen }}">
            <div class="datosProducto">
                <div class="desc">
                    <h2>Descripción: <span>{{ $producto->descripcion }}</span></h2>
                </div>
                <div class="datos">
                    <h2>Ventas totales: <span>{{ $ventas }}</span></h2>
                    <h2>Fecha de publicación: <span>{{ $producto->created_at }}</span></h2>
                </div>
            </div>
        </div>
        <div class="preguntas">
            <h1>Preguntas</h1>
            @forelse ($preguntas as $pregunta)
                <div class="pregunta">
                    <h3>{{ $pregunta->pregunta }}</h3>
                    <p>- {{ $pregunta->pregunta_fecha }}</p>
                </div>
                <div class="respuesta">
                    @if ($pregunta->respuesta)
                        <p>{{ $pregunta->respuesta }}</p>
                    @endif
                </div>
            @empty
                <h2>No hay preguntas sobre este producto.</h2>
            @endforelse
        </div>
    </div>
@endsection