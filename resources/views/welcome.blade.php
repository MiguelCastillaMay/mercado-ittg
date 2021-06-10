@extends('layout')

@section('title', 'Mercado ITTG')

@php
    $usuario = Auth::User();
@endphp

@section('navBar')
    <div class="menuBar">
        <h1>Mercado ITTG</h1>
        <ul>
            <li><a href="/categoria">Categorías</a></li>
            <li><a href="/productos">Productos</a></li>
            @if (is_null($usuario) or $usuario->rol == 'Cliente')
                <li><form action="/search" method="get" role="search">
                    <input type="text" name="find" placeholder="Buscar productos">
                    <button type="submit">Buscar</button>
                </form></li>
            @elseif ($usuario->rol == 'Supervisor' or $usuario->rol == 'Revisor')
                <li><a href="/productos">Bitácora</a></li>
            @endif
            @if (is_null($usuario))
                <li><a href="/login">Iniciar sesión</a></li>
            @elseif ($usuario->rol == 'Cliente')
                <li><a href="/usuario/show/{{ $usuario->usuarioID }}">Mi perfil</a></li>
                <li><a href="/propuestas/show"></a></li>
            @endif
        </ul>
    </div>
@endsection
    
@section('contenido')
    @if (session('mensaje'))
        <p class="info">{{ session('mensaje') }}</p>
    @endif
    @if (is_null($usuario) or $usuario->rol == 'Cliente')
        @isset($productos)
            <div class="catalogo">
                @foreach ($productos as $producto)
                    <div class="producto">
                        <img src="{{ url('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}">
                        <div class="datosProducto">
                            <h1>{{ $producto->nombre }}</h1>
                            <p>{{ $producto->descripcion }}</p>
                            <p>Precio</p>
                            <button id="botonInverso"><a href="/producto/comprar/{{ $producto->productoID }}">Comprar</a></button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset
    @elseif ($usuario->rol == 'Supervisor' or $usuario->rol == 'Revisor')
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
    @endif
    
    @if ($usuario)
        {{-- <button id="botonInverso" class="pafuera"><a href="/propuesta/create">Agregar producto</a></button> --}}
        <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
    @endif
@endsection