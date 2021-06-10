@extends('layout')

@section('title', 'Mis productos')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="/categoria">Categorias</a></li>
            <li><a href="/productos">Productos</a></li>
            <li><form action="/search" method="get" role="search">
                <input type="text" name="find" placeholder="Buscar productos">
                <button type="submit">Buscar</button>
            </form></li>
            <li><a href="/usuario/show/{{ Auth::User()->usuarioID }}">Mi perfil</a></li>
        </ul>
    </div>
@endsection

@section('contenido')
    @isset($productos)
        <div class="catalogo">
            @foreach ($productos as $producto)
                <div class="producto">
                    <img src="{{ url('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}">
                    <div class="datosProducto">
                        <h1>{{ $producto->nombre }}</h1>
                        <p>{{ $producto->descripcion }}</p>
                        <p>Precio</p>
                        <button id="botonInverso"><a href="/preguntas/{{ $producto->productoID }}">Ver preguntas</a></button>
                    </div>
                </div>
            @endforeach
        </div>
    @endisset
    <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
@endsection