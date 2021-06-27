@extends('layout')

@section('title', 'Mis productos')

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
        margin-top: 0px;
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
    h2.titulo {
        display: flex;
        justify-content: center;
        font-size: 2em;
        font-weight: 300;
        margin: 0px;
        margin-bottom: 40px;
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
    @isset($productos)
        <div class="catalogo">
            <h2 class="titulo">Mis productos</h2>
            @forelse ($productos as $producto)
                <div class="producto">
                    <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                    <div class="datosProducto">
                        <h2>{{ $producto->nombre }}</h2>
                        <p>{{ $producto->descripcion }}</p>
                        <p>${{ $producto->precio }} MXN C/U</p>
                        <a class="boton" href="/preguntas/{{ $producto->productoID }}">Ver preguntas</a>
                    </div>
                </div>
            @empty
                <h2 class="mensaje">No has agregado ningún producto</h2>
            @endforelse
        </div>
    @endisset
    <a class="boton pafuera" href="/salir">Salir pa fuera</a>
@endsection