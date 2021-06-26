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
                    <input  type="submit" value="Buscar" id="botonInverso">
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
    }
    h2.titulo {
        display: flex;
        justify-content: center;
        font-size: 2em;
        font-weight: 300;
        margin: 0px;
    }
    textarea {
        resize: none;
    }
    input[type=text], input[type=number], input[type=file], select, textarea {
        border-radius: 5px;
        font-size: 17px;
        border-width: 1px;
        color: #1e212d;
        font-family: "Montserrat", sans-serif;
        font-weight: 400;
    }
    input[type=file] {
        border-radius: 0px;
    }
    .opciones {
        display: flex;
        justify-content: space-between
    }
    form {
        margin: 0px;
    }
    .registro {
        margin-top: 10px;
        display: block;
        margin-right: auto;
        margin-left: auto;
    }
</style>
    
@section('contenido')
@if (session('error'))
    <h2>{{ session('error') }}</h2>
@endif
<div class="catalogo" style="padding-bottom: 40px;">
    <h2 class="titulo">Agregar un producto nuevo</h2>
    <form action="/producto/store" method="post" enctype="multipart/form-data">
        @csrf
        <div class="nombre">
            <h2>Nombre</h2>
            <input type="text" name="nombre" value="">
        </div>
        <div class="desc">
            <h2>Descripción</h2>
            <textarea name="desc" id="" cols="60" rows="5"></textarea>
        </div>
        <div class="opciones">
            <div class="categoria">
                <h2>Categoria</h2>
                <select name="categoria">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->categoriaID }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="precio">
                <h2>Precio unitario (MXN)</h2>
                <input type="number" name="precio" value="0">
            </div>
            <div class="cantidad">
                <h2>Cantidad</h2>
                <input type="number" name="cantidad" value="1">
            </div>
        </div>
        <div class="imagen">
            <h2>Imagen</h2>
            <input type="file" name="imagen">
        </div>
        <input type="submit" value="Agregar producto" id="botonInverso" class="registro">
    </form>
</div>
@endsection