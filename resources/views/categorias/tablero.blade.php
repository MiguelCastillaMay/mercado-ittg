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
    img {
        height: 250px;
        width: 250px;
        object-fit: cover;
        display: block;
        margin-bottom: 10px;
        border-radius: 10px;
    }
    h2 {
        color: #1e212d;
        margin-top: 10px;
        margin-bottom: 10px;
        font-size: 30px;margin-bottom: 10px;
        font-weight: 500;
    }
    p {
        margin-top: 15px;
        margin-bottom: 15px;
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
    @if (session('mensaje'))
        <p>{{ session('mensaje') }}</p>
    @endif
    @if(is_null($usuario) or $usuario->rol == 'Cliente')
            <div class="catalogo">
                @forelse ($categorias as $categoria)
                    <div class="producto">
                        <img src="{{ $categoria->imagen }}" alt="{{ $categoria->nombre }}">
                        <div class="datosProducto">
                            <h2>{{ $categoria->nombre }}</h2>
                            <p>{{ $categoria->descripcion }}</p>
                            <a class="boton" href="/productos/categoria/{{ $categoria->categoriaID }}">Ver productos</a>
                        </div>
                    </div>
                @empty
                    <h2>Oh oh, no hay categorías :(</h2>
                @endforelse
            </div>
    @elseif ($usuario->rol == 'Supervisor' or $usuario->rol == 'Revisor')
        <table>
            <tr>
                <th>Categoría</th>
                <th>Cantidad de productos</th>
                <th>Acciones</th>
            </tr>
            @forelse ($categorias as $categoria)
                @php
                    $cantidad = DB::select('SELECT nombre FROM productos WHERE categoriaID = ?', [$categoria->categoriaID]);
                    $cantidad = count($cantidad);
                @endphp
                <tr>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ $cantidad }}</td>
                    <td id="botones">
                        <a class="boton opciones" href="/productos/categoria/{{ $categoria->categoriaID }}">Ver productos</a>
                        <a class="boton opciones" href="/categoria/{{ $categoria->categoriaID }}/edit">Editar categoría</a>
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