@extends('layout')

@section('title', 'Nuevo usuario')

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

@section('contenido')
<div id="cuadro">
    <h1>Agregar un usuario</h1>
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif
    <form action="/usuario/store" method="post" enctype="multipart/form-data">
        @csrf
        <div id="form">
            <div>
                <p>Nombre:</p>
                <p>Apellido paterno:</p>
                <p>Apellido materno:</p>
                <p>Correo:</p>
                <p>Imagen:</p>
                <p>Tipo de usuario:</p>
                <p>Contraseña:</p>
                <p>Repita la contraseña</p>
            </div>
            <div>
                <input type="text" name="nombre" value="">
                <input type="text" name="a_paterno" value="">
                <input type="text" name="a_materno" value="">
                <input type="text" name="correo" value="">
                <input type="file" name="imagen">
                <select name="rol">
                    <option>Supervisor</option>
                    <option>Revisor</option>
                    <option>Contador</option>
                    <option>Cliente</option>
                </select>
                <input type="password" name="password">
                <input type="password" name="password2">
            </div>
        </div>
        <input type="submit" value="Agregar" id="boton">
    </form>
</div>
@endsection