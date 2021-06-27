@extends('layout')

@section('title', 'Tablero de productos')

<style>
    a.boton, input.boton {
        -webkit-appearance: button;
        -moz-appearance: button;
        appearance: button;
        background-color: #1e212d;
        border-style: solid;
        border-color: #1e212d;
        font-size: 25px;
        padding: 10px;
        border-radius: 15px;
        color: #f0f8ff;
        transition-duration: 0.4s;
        cursor: pointer;
        font-family: "Montserrat", sans-serif;
        margin-bottom: 10px;
    }
    
    a.boton:hover, input.boton:hover {
        background-color: #f0f8ff;
        color: #1e212d;
    }
    .pafuera {
        display: block;
        width: fit-content;
        margin-top: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    a.opciones, input.opciones {
        font-weight: 100;
        font-size: 15px;
        display: inline;
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
    }
    form {
        display: inline;
        margin: 0px;
    }
    #botones {
        padding-top: 10px;
    }
</style>

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
    
@section('contenido')
    <table>
        <tr>
            <th>Productos</th>
            <th>Cantidad disponible</th>
            <th>Acciones</th>
        </tr>
        @forelse ($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->cantidad }}</td>
                <td id="botones">
                    <a class="boton opciones" href="/producto/{{ $producto->productoID }}">Detalles del producto</a>
                    <form action="/producto/delete/{{ $producto->productoID }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="boton opciones" type="submit" value="Eliminar producto">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan = "3">Sin registros</tr>
            </tr>
        @endforelse
    </table>
    <a class="boton pafuera" href="/producto/create">Agregar producto</a>
    <a class="boton pafuera" href="/salir">Salir pa fuera</a>
@endsection