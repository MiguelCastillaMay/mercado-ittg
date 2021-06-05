@extends('layout')

@section('title', 'Categorías')

@php
    $usuario = Auth::User();
@endphp

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="/categoria">Categorías</a></li>
            <li><a href="/productos">Productos</a></li>
            <li><form action="/search" method="get" role="search">
                <input type="text" name="find" placeholder="Buscar productos">
                <button type="submit">Buscar</button>
            </form></li>
            @if (is_null($usuario))
                <li><a href="/login">Iniciar sesión</a></li>
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
                                <button id="botonInverso"><a href="/productos/categoria/{{ $categoria->categoriaID }}">Ver productos</a></button>
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
                        <td>
                            <button id="edit"><a href="/categoria/{{ $categoria->categoriaID }}/edit">Editar categoría</a></button>
                            <button id="show"><a href="/categoria/{{ $categoria->categoriaID }}">Mostrar categoría</a></button>
                            <form action="/categoria/{{ $categoria->categoriaID }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Eliminar categoría" id="eliminar">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan = "3">Sin registros</tr>
                    </tr>
                @endforelse
            </table>
            <button id="botonInverso" class="pafuera"><a href="/categoria/create">Agregar categoría</a></button>
            <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
        @endif
@endsection