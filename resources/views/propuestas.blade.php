@extends('layout')

@section('title', 'Propuestas')

<style>
    a.boton, input.boton {
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
    
    a.boton:hover, input.boton {
        background-color: #f0f8ff;
        color: #1e212d;
    }
    h1.titulo {
        color: #1e212d;
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
    }
    h2, p {
        color: #1e212d;
    }
    h2 {
        font-weight: 500;
    }
    span {
        font-weight: 300;
    }
    .pafuera {
        display: block;
        width: fit-content;
        margin-top: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    textarea {
        resize: none;
        margin-right: 20px;
        font-family: "Montserrat", sans-serif;
        border-radius: 15px;
        font-size: 17px;
    }
    .datos {
        display: flex;
    }
    .datos > h2 {
        margin-top: 0px;
    }
    form {
        display: flex;
    }
    .botones {
        display: flex;
        flex-direction: column;
        align-self: center;
        text-align: center;
    }
    img {
        height: 250px;
        width: 250px;
        object-fit: cover;
        display: block;
        margin-bottom: 10px;
        border-radius: 10px;
    }
    .producto {
        display: flex;
    }
    form {
        margin-bottom: 40px;
    }
</style>

@php
    $usuario = Auth::User();
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
                <li><a href="/bitacora">Bitácora</a></li>
            @endif
        </ul>
    </div>
@endsection
    
@section('contenido')
<h2>{{session('error')}}</h2>
        <div class="catalogo" style="padding-bottom: 40px;">
            <h1 class="titulo">Propuestas</h1>
            @forelse ($propuestas as $propuesta)
                <div class="producto" style="margin-bottom: 10px;">
                    <img src="{{ $propuesta->imagen }}">
                    <div class="datosProducto">
                        <h2>{{ $propuesta->nombre }}</h2>
                        <div class="desc">
                            <h2>Descripción: <span>{{ $propuesta->descripcion }}</span></h2>
                        </div>
                        <div class="datos">
                            <h2 style="margin-right: 25px;">Precio: <span>{{ $propuesta->precio }}</span></h2>
                            <h2>Cantidad: <span>{{ $propuesta->cantidad }}</span></h2>
                        </div>
                    </div>
                </div>
                <form action="/propuesta/rechazar/{{ $propuesta->productoID }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <textarea name="razon" cols="80" rows="10" placeholder="Agregar una razón del rechazo (Obligatorio)"></textarea>
                    <div class="botones">
                        <a class="boton" href="/propuesta/aceptar/{{ $propuesta->productoID }}">Aceptar</a>
                        <input id="botonInverso" type="submit" value="Rechazar">
                    </div>
                </form>
            @empty
                <h2>No hay propuestas</h2>
            @endforelse
        </div>
        
        <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
@endsection