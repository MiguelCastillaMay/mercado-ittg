@extends('layout')

@section('title', 'Ver perfil')

@php
    $usuarioAuth = Auth::User()
@endphp

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
    #botones {
        flex-wrap: wrap;
        text-align: center;
        justify-content: space-evenly;
    }
    h2 {
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
    }
    h2, h3, p {
        color: #1e212d;
    }
    .pregunta {
        display: flex;
    }
    .pregunta > p {
        margin-top: 21px;
        margin-left: 5px;
    }
    img {
        height: max-content;
        display: block;
        margin-bottom: 10px;
        border-radius: 10px;
    }
</style>

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            @if ($usuarioAuth->rol == 'Supervisor' or $usuarioAuth->rol == 'Revisor')
                <li><a href="/supervisor">Menú</a></li>
            @endif
            <li><a href="/categoria">Categorias</a></li>
            <li><a href="/productos">Productos</a></li>
            @if ($usuarioAuth->rol == 'Cliente')
                <li><form action="/search" method="get" role="search">
                    <input type="text" name="find" placeholder="Buscar productos">
                    <button type="submit">Buscar</button>
                </form></li>
            @elseif ($usuarioAuth->rol == 'Supervisor' or $usuarioAuth->rol == 'Revisor')
                <li><a href="/usuarios">Usuarios</a></li>
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
                <div id="botones">
                    <a class="boton caja" href="/usuario/edit/{{ $usuario->usuarioID }}">Editar perfil</a>
                    <a class="boton caja" href="/productos/usuario/{{ $usuario->usuarioID }}">Ver mis productos</a>
                    <a class="boton caja" href="/propuestas/usuario/{{ $usuario->usuarioID }}">Ver mis propuestas</a>
                    <a class="boton caja" href="/producto/create">Agregar un producto</a>
                    <a class="boton caja" href="/usuario/{{ $usuario->usuarioID }}/compras" class="boton">Mis compras</a>
                    <a class="boton caja" href="/usuario/{{ $usuario->usuarioID }}/ventas" class="boton">Mis ventas</a>
                </div>
            </div>
        </div>
    @elseif ($usuarioAuth->rol == 'Supervisor')
    <div id="datosPersonales">
        <div>
            <img src="{{ url('storage/'.$usuario->imagen) }}">
            <a class="boton" href="/usuario/edit/{{ $usuario->usuarioID }}">Editar perfil</a>
        </div>
        <div>
            <p id="nombre">{{ $usuario->nombre }} {{ $usuario->a_paterno }} {{ $usuario->a_materno }}</p>
            <p>{{ $usuario->rol }}</p>
            <p>{{ $usuario->correo }}</p>
            <p>Fecha de registro: {{ $usuario->created_at }}</p>
            <p>Ventas totales: {{ $ventas }}</p>
            <p>Productos en venta: {{ $productos }}</p>
            <div class="preguntas">
                @forelse ($preguntas as $pregunta)
                    <div class="pregunta">
                        <h3>{{ $pregunta->producto }}: {{ $pregunta->pregunta }}</h3>
                        <p>- {{ $pregunta->pregunta_fecha }}</p>
                    </div>
                    <div>
                        @if ($pregunta->respuesta)
                            <p>{{ $pregunta->respuesta }} - {{ $pregunta->respuesta_fecha }}</p>
                        @endif
                    </div>
                @empty
                    <h2>Este usuario no ha realizado ninguna pregunta.</h2>
                @endforelse
            </div>
        </div>
    </div>
    @endif
    <a href="/salir" class="boton pafuera">Salir pa fuera</a>
@endsection