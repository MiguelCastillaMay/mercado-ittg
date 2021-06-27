@extends('layout')

@section('title', 'Nueva categoria')

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

<style>
    h1.titulo {
        color: #1e212d;
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
    }
    h2, h3, p {
        color: #1e212d;
    }
    textarea {
        resize: none;
        margin-right: 20px;
        font-family: "Montserrat", sans-serif;
        border-radius: 15px;
        font-size: 17px;
    }
    input[type=text], input[type=number], input[type=file], input[type=password] {
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
    .categoria {
        display: flex;
    }
    .datos {
        margin-left: 20px;
    }
    .imagen {
        display: flex;
        justify-content: space-between;
    }
</style>
    
@section('contenido')
@if (session('error'))
    <h2 style="display: flex; justify-content: center;">{{ session('error') }}</h2>
@endif    
    <div class="catalogo" style="padding-bottom: 40px;">
        <h1 class="titulo">Agregar categoría</h1>
        <form action="/categoria" method="post" enctype="multipart/form-data">
            @csrf
            <div class="categoria">
                <div class="datos">
                    <div class="nombre">
                        <h3 style="margin-top: 0px;">Nombre</h3>
                        <input type="text" name="nombre" placeholder="Obligatorio" value="">
                    </div>
                    <div class="desc">
                        <h3>Descripción</h3>
                        <textarea name="desc" cols="80" rows="5" placeholder="Obligatorio"></textarea>
                    </div>
                    <div class="imagen">
                        <div>
                            <h3>Seleccione una imagen</h3>
                            <input type="file" name="imagen">
                        </div>
                        <input type="submit" value="Agregar" id="botonInverso" style="margin-top: 18.720px; margin-bottom: 18.720px; margin-right: 20px;">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection