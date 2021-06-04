@extends('layout')

@section('title', 'Mercado ITTG')

@section('navBar')
<div class="menuBar">
    <h1>Mercado ITTG</h1>
    <ul>
        <li><a href="/categoriasguest">Categorías</a></li>
        <li><a href="#">Productos</a></li>
        <li><form action="/search" method="get" role="search">
            <input type="text" name="find" placeholder="Buscar productos">
            <button type="submit">Buscar</button>
        </form></li>
        <li><a href="/login">Iniciar sesión</a></li>
    </ul>
</div>
@endsection
    
@section('contenido')
    @if (session('mensaje'))
        <p class="info">{{ session('mensaje') }}</p>
    @endif
    @isset($productos)
        <div class="catalogo">
            @foreach ($productos as $producto)
                <div class="producto">
                    <img src="{{ url('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}">
                    <div class="datosProducto">
                        <h1>{{ $producto->nombre }}</h1>
                        <p>{{ $producto->descripcion }}</p>
                        <p>Precio</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endisset
@endsection