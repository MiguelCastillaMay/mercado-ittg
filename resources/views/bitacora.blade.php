@extends('layout')

@section('title', 'Bitacora')

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
                <li><a href="/productos">Bitácora</a></li>
            @endif
        </ul>
    </div>
@endsection

@section('contenido')
    <table>
        <tr>
            <th>Quién</th>
            <th>Cuándo</th>
            <th>Acción</th>
            <th>Qué</th>
        </tr>
        @foreach ($registros as $registro)
            <tr>
                <td>{{ $registro->quien }}</td>
                <td>{{ $registro->cuando }}</td>
                <td>{{ $registro->accion }}</td>
                <td>{{ $registro->que }}</td>
            </tr>
        @endforeach
    </table>
@endsection