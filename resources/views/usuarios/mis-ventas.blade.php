@extends('layout')

@section('title', 'Mis compras')

<style>
    h2 {
        color: #1e212d;
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }
    img {
        height: max-content;
        width: 35%;
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
        @forelse ($ventas as $ventas)
            <div class="producto">
                <img src="{{ url('storage/'.$ventas->imagen) }}" alt="{{ $ventas->nombre }}">
                <div class="datosProducto">
                    <h1>{{ $ventas->nombre }}</h1>
                    <p>{{ $ventas->descripcion }}</p>
                    <p>${{ $ventas->precio }} MXN C/U</p>
                    <p>Cantidad comprada: {{ $ventas->cantidad }}</p>
                    <p>Total: ${{ $ventas->total }} MXN</p>
                    <p>Fecha de compra: {{ $ventas->fecha }}</p>
                </div>
            </div>
        @empty
            <h2>No has vendido nada aún.</h2>
        @endforelse
    </div>
    <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
@endsection