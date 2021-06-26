@extends('layout')

@section('title', 'Cliente')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="#">Categorías</a></li>
            <li><a href="#">Productos</a></li>
            <li><form action="/search" method="get" role="search">
                <input type="text" name="find" placeholder="Buscar productos">
                <input  type="submit" value="Buscar" id="botonInverso">
            </form></li>
            <li><a href="/usuario/show/{{ $usuario->usuarioID }}">Mi perfil</a></li>
        </ul>
    </div>
@endsection

@section('contenido')
    <table>
        <tr>
            <th>Categoría</th>
            <th>Productos</th>
        </tr>
        @forelse ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->nombre }}</td>
                <td>3</td>
            </tr>
        @empty
            
        @endforelse
    </table>
    <a href="/salir"><button id="botonInverso" class="pafuera">Salir pa fuera</button></a>
@endsection