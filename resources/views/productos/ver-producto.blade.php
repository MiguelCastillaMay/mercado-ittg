@extends('layout')

@section('title', $producto->nombre)

@php
    $usuario = Auth::User();
@endphp
<style>
    .datosProducto > form {
        display: flex;
        flex-direction: column;
    }
    .datosProducto > form > input {
        margin-bottom: 15px;
    }
    .preguntar > form {
        display: flex;
        flex-direction: column;
    }
    .preguntar > form > textarea {
        margin-bottom: 15px;
        resize: none;
    }
    h2, h3, p {
        color: #1e212d;
    }
    .preguntar {
        justify-items: center
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
    #mensaje {
        width: fit-content;
        margin-left: auto;
        margin-right: auto;
    }
    #botonInverso {
        font-weight: 100;
    }
    img {
        width: 35%;
        height: max-content;
    }
    .respuesta > p {
        margin-top: 0px;
    }
</style>

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
        <h2 id="mensaje">{{ session('mensaje') }}</h2>
    @endif
    <div class="catalogo">
        <div class="producto">
            <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
            <div class="datosProducto">
                <h1>{{ $producto->nombre }}</h1>
                <p>{{ $producto->descripcion }}</p>
                <p>${{ $producto->precio }} MXN C/U</p>
                @if (is_null($usuario))
                    <h3>Inicie sesión para poder comprar.</h3>
                @elseif($producto->usuarioID != Auth::User()->usuarioID)
                    <form action="/producto/comprar/{{ $producto->productoID }}" method="post">
                        @csrf
                        <input class="cantidad" type="number" id="cantidad" name="cantidad" value="1" min="1" max="{{ $producto->cantidad }}">
                        <button id="botonInverso" type="submit">Comprar</button>
                        <input type="hidden" name="precio" value="{{ $producto->precio }}">
                    </form>
                @endif
            </div>
        </div>
        <div class="preguntar">
            @can('preguntar', $producto)
                @if ($producto->usuarioID != Auth::User()->usuarioID)
                    <h2>Haz una pregunta</h2>
                    <form action="/pregunta/{{ $producto->productoID }}" method="post">
                        @csrf
                        <textarea name="pregunta" id="" cols="30" rows="10"></textarea>
                        <input type="submit" id="botonInverso" value="Preguntar">
                    </form>
                @endif
            @else
                <h2>Inicia sesión para hacer una pregunta.</h2>
            @endcan
        </div>
        <div class="preguntas">
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
                <h2>No hay preguntas sobre este producto. ¡Sé el primero!</h2>
            @endforelse
        </div>
    </div>
    <script>
        var input = document.getElementById('cantidad');
        input.onkeypress=function(evt){
            evt.preventDefault();
        };
    </script>
@endsection