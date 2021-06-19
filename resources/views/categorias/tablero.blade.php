@extends('layout')

@section('title', 'Categorías')

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
            @else
                <li><a href="/supervisor">Menú</a></li>
            @endif
            <li><a href="/productos">Productos</a></li>
            @if (is_null($usuario) or $usuario->rol == 'Cliente')
                <li><form action="/search" method="get" role="search">
                    <input type="text" name="find" placeholder="Buscar productos">
                    <button type="submit">Buscar</button>
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

@section('contenido')
    @if (session('mensaje'))
        <p>{{ session('mensaje') }}</p>
    @endif
        @if(is_null($usuario) or $usuario->rol == 'Cliente')
            @isset($categorias)
                <div class="catalogo">
                    @foreach ($categorias as $categoria)
                        <div class="producto">
                            <img src="{{ url('storage/'.$categoria->imagen) }}" alt="{{ $categoria->nombre }}">
                            <div class="datosProducto">
                                <h1>{{ $categoria->nombre }}</h1>
                                <p>{{ $categoria->descripcion }}</p>
                                <a class="boton" href="/productos/categoria/{{ $categoria->categoriaID }}">Ver productos</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endisset
        @elseif ($usuario->rol == 'Supervisor' or $usuario->rol == 'Revisor')
            <table>
                <tr>
                    <th>Categoría</th>
                    <th>Cantidad de productos</th>
                    <th>Acciones</th>
                </tr>
                @forelse ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nombre }}</td>
                        <td>3</td>
                        <td id="botones">
                            <a class="boton opciones" href="/productos/categoria/{{ $categoria->categoriaID }}">Ver productos</a>
                            <a class="boton opciones" href="/categoria/{{ $categoria->categoriaID }}/edit">Editar categoría</a>
                            <a class="boton opciones" href="/categoria/{{ $categoria->categoriaID }}">Mostrar categoría</a>
                            <form action="/categoria/{{ $categoria->categoriaID }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input class="boton opciones" type="submit" value="Eliminar categoría" id="eliminar">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan = "3">Sin registros</tr>
                    </tr>
                @endforelse
            </table>
            <a class="boton pafuera" href="/categoria/create">Agregar categoría</a>
        @endif
        @if ($usuario)
            <a class="boton pafuera" href="/salir">Salir pa fuera</a>
        @endif
@endsection