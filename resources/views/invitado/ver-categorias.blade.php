@extends('layout')

@section('title', 'Categorías')

@php
    $usuario = Auth::User();
@endphp

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            @if (is_null($usuario) or $usuario->rol == 'Cliente')
                <li><a href="/categoria">Categorías</a></li>
            @else
                <li><a href="/supervisor">Menú</a></li>
            @endif
            <li><a href="/productos">Productos</a></li>
            @if (is_null($usuario) or $usuario->rol == 'Cliente')
                <li><form action="/search" method="get" role="search">
                    <input type="text" name="find" placeholder="Buscar productos">
                    <input  type="submit" value="Buscar" id="botonInverso">
                </form></li>
            @endif
            @if (is_null($usuario))
                <li><a href="/login">Iniciar sesión</a></li>
            @elseif ($usuario->rol == 'Cliente')
                <li><a href="/usuario/show/{{ $usuario->usuarioID }}">Mi perfil</a></li>
            @endif
            @if (!is_null($usuario) and $usuario->rol == 'Supervisor')
                <li><a href="/usuarios">Usuarios</a></li>
                <li><a href="/bitacora">Bitácora</a></li>
            @endif
        </ul>
    </div>
@endsection

@section('navBar')
<div class="menuBar">
    <h1>Mercado ITTG</h1>
    <ul>
        <li><a href="#">Categorías</a></li>
        <li><a href="#">Productos</a></li>
        <li><form action="/search" method="get" role="search">
            <input type="text" name="find" placeholder="Buscar productos">
            <input  type="submit" value="Buscar" id="botonInverso">
        </form></li>
        <li><a href="/login">Iniciar sesión</a></li>
    </ul>
</div>
@endsection
    
@section('contenido')
    
@endsection