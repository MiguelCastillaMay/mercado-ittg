@extends('layout')

@section('title', 'Mis ventas')

<style>
    h2#mensaje {
        color: #1e212d;
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
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
        margin-bottom: 0px;
        font-size: 30px;
    }
    h2.mensaje {
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
    }
    p {
        margin-top: 12px;
        margin-bottom: 12px;
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
    <div class="catalogo">
        <h2 class="titulo">Mis ventas</h2>
        @forelse ($ventas as $ventas)
            <div class="producto">
                <img src="{{ $ventas->imagen }}" alt="{{ $ventas->nombre }}">
                <div class="datosProducto">
                    <h2>{{ $ventas->nombre }}</h2>
                    <p>{{ $ventas->descripcion }}</p>
                    <p>${{ $ventas->precio }} MXN C/U</p>
                    <p>Cantidad comprada: {{ $ventas->cantidad }}</p>
                    <p>Total: ${{ $ventas->total }} MXN</p>
                    <p>Fecha de compra: {{ $ventas->fecha }}</p>
                </div>
            </div>
        @empty
            <h2 class="mensaje">No has vendido nada aún.</h2>
        @endforelse
    </div>
    <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
@endsection