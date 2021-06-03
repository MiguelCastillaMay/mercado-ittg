@extends('layout')

@section('title', 'Tablero de categorías')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="#">Menú</a></li>
            <li><a href="#">Categorías</a></li>
            <li><a href="#">Ofertas</a></li>
        </ul>
    </div>
@endsection

@section('contenido')
@if (session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif
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
                    <button id="show"><a href="/categoria/show/{{ $categoria->categoriaID }}">Mostrar categoría</a></button>
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
@endsection