@extends('layout')

@section('title', 'Detalles de producto')

@php
    $usuarioAuth = Auth::User()
@endphp
    
@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            @if ($usuarioAuth->rol == 'Supervisor' or $usuarioAuth->rol == 'Revisor')
                <li><a href="/supervisor">Menú</a></li>
            @endif
            <li><a href="/usuarios">Usuarios</a></li>
            <li><a href="/productos">Productos</a></li>
            @if ($usuarioAuth->rol == 'Cliente')
                <li><form action="/search" method="get" role="search">
                    <input type="text" name="find" placeholder="Buscar productos">
                    <input  type="submit" value="Buscar" id="botonInverso">
                </form></li>
            @elseif ($usuarioAuth->rol == 'Supervisor' or $usuarioAuth->rol == 'Revisor')
                <li><a href="/categoria">Categorías</a></li>
                <li><a href="/bitacora">Bitácora</a></li>
            @endif
        </ul>
    </div>
@endsection

@section('contenido')
    <div id="cuadro">
        <h1>{{ $producto->nombre }}</h1>
        <p>{{ $producto->descripcion }}</p>
        <p>Ventas del producto: {{ $ventas }}</p>
        <p>Fecha de publicación: {{ $producto->created_at }}</p>
        @forelse ($preguntas as $pregunta)
            <p>{{ $pregunta->pregunta }}</p>
        @empty
            <h2>No se han realizado preguntas sobre el producto.</h2>
        @endforelse
        <button id="botonInverso"><a href="/productos">Volver atrás</a></button>
    </div>
@endsection