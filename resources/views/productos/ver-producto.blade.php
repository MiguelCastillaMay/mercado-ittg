@extends('layout')

@section('title', $producto->nombre)

@php
    $usuarioAuth = Auth::User();
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
    }
    #mensaje {
        width: fit-content;
        margin-left: auto;
        margin-right: auto;
    }
    #botonInverso {
        font-weight: 100;
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
        <h2 id="mensaje">{{ session('mensaje') }}</h2>
    @endif
    <div class="catalogo">
        <div class="producto">
            <img src="{{ url('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}">
            <div class="datosProducto">
                <h1>{{ $producto->nombre }}</h1>
                <p>{{ $producto->descripcion }}</p>
                <p>Precio</p>
                <form action="/producto/comprar/{{ $producto->productoID }}" method="post">
                    @csrf
                    <input type="number" name="cantidad" value="1" id="">
                    <button id="botonInverso" type="submit">Comprar</button>
                    <input type="hidden" name="precio" value="{{ $producto->precio }}">
                </form>
            </div>
        </div>
        <div class="preguntar">
            @can('preguntar', $producto)
                <h2>Haz una pregunta</h2>
                <form action="/pregunta/{{ $producto->productoID }}" method="post">
                    @csrf
                    <textarea name="pregunta" id="" cols="30" rows="10"></textarea>
                    <input type="submit" id="botonInverso" value="Preguntar">
                </form>
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
                <div>
                    @if ($pregunta->respuesta)
                        <p>{{ $pregunta->respuesta }}</p>
                    @endif
                </div>
            @empty
                <h2>No hay preguntas sobre este producto. ¡Sé el primero!</h2>
            @endforelse
        </div>
    </div>
@endsection