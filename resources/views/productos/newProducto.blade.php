@extends('layout')

@section('title', 'Nuevo producto')

@php
    $usuarioAuth = Auth::User();
@endphp

@section('navBar')
    <div class="menuBar">
        <h1>Mercado ITTG</h1>
        <ul>
            <li><a href="/categoria">Categorías</a></li>
            <li><a href="/productos">Productos</a></li>
            @if (is_null($usuarioAuth) or $usuarioAuth->rol == 'Cliente')
                <li><form action="/search" method="get" role="search">
                    <input type="text" name="find" placeholder="Buscar productos">
                    <button type="submit">Buscar</button>
                </form></li>
            @elseif ($usuarioAuth->rol == 'Supervisor' or $usuarioAuth->rol == 'Revisor')
                <li><a href="/productos">Bitácora</a></li>
            @endif
            @if (is_null($usuarioAuth))
                <li><a href="/login">Iniciar sesión</a></li>
            @elseif ($usuarioAuth->rol == 'Cliente')
                <li><a href="/usuario/show/{{ $usuarioAuth->usuarioID }}">Mi perfil</a></li>
            @endif
        </ul>
    </div>
@endsection

<style>
    h2 {
        color: #1e212d;
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
    }
</style>
    
@section('contenido')
@if (session('error'))
    <h2>{{ session('error') }}</h2>
@endif
<div id="cuadro" style="margin-top: 40px">
    <h1>Agregar un producto nuevo</h1>
    <form action="/producto/store" method="post" enctype="multipart/form-data">
        @csrf
        <div id="form">
            <div>
                <p>Nombre del producto:</p>
                <p>Descripción del producto:</p>
                <p>Categoría: </p>
                <p>Precio: </p>
                <p>Cantidad: </p>
                <p>Imagen: </p>
            </div>
            <div>
                <input type="text" name="nombre" value="">
                <input type="text" name="desc" value="">
                <select name="categoria">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->categoriaID }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                <input type="number" name="precio" value="0">
                <input type="number" name="cantidad" value="1">
                <input type="file" name="imagen">
            </div>
        </div>
        <input type="submit" value="Agregar" id="boton">
    </form>
</div>
@endsection