@extends('layout')

@section('title', $producto->nombre)

<style>
    h2, h3, p {
        color: #1e212d;
    }
    .pregunta {
        display: flex;
    }
    .pregunta > p {
        margin-top: 21px;
        margin-left: 5px;
        margin-bottom: 0px;
    }
    .pregunta > h3 {
        margin-bottom: 8px;
    }
    #responder {
        font-size: 18px;
    }
    textarea {
        resize: none;
        margin-bottom: 8px;
    }
    .respuesta {
        display: flex;
    }
    #fecha {
        margin-left: 5px;
    }
    .producto {
        margin-bottom: 0px;
    }
</style>

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="/categoria">Categorias</a></li>
            <li><a href="/productos">Productos</a></li>
            <li><form action="/search" method="get" role="search">
                <input type="text" name="find" placeholder="Buscar productos">
                <input  type="submit" value="Buscar" id="botonInverso">
            </form></li>
            <li><a href="/usuario/show/{{ Auth::User()->usuarioID }}">Mi perfil</a></li>
        </ul>
    </div>
@endsection

@section('contenido')
    @isset($preguntas)
    <div class="catalogo">
        <div class="producto">
            <img src="{{ url('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}">
            <div class="datosProducto">
                <h1>{{ $producto->nombre }}</h1>
                <p>{{ $producto->descripcion }}</p>
                <p>Precio</p>
            </div>
        </div>
        <div class="preguntas">
            <h2>Preguntas</h2>
            @forelse ($preguntas as $pregunta)
                <div class="pregunta">
                    <h3>{{ $pregunta->pregunta }}</h3>
                    <p id="fecha">- {{ $pregunta->pregunta_fecha }}</p>
                </div>
                <div>
                    @if ($pregunta->respuesta)
                        <div class="respuesta">
                            <p>{{ $pregunta->respuesta }}</p>
                            {{-- <p id="fecha">- {{ $pregunta->respuesta_fecha }}</p> --}}
                        </div>
                    @else
                        <form action="/responder/{{ $pregunta->preguntaID }}" method="post">
                            @csrf
                            <textarea name="respuesta" id="" cols="60" rows="5"></textarea>
                            <button type="submit" id="botonInverso">Responder</button>
                        </form>
                    @endif
                </div>
            @empty
                <h2>No tienes preguntas sobre este producto</h2>
            @endforelse
        </div>
    </div>
    @endisset
    <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
@endsection