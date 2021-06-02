@extends('layout')

@section('title', 'Tablero de productos')

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
    <table>
        <tr>
            <th>Productos</th>
            <th>Cantidad disponible</th>
            <th>Acciones</th>
        </tr>
        @forelse ($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>3</td>
                <td>
                    <button id="edit"><a href="/producto/edit/{{ $producto->productoID }}">Editar producto</a></button>
                    <button id="show"><a href="/producto/show/{{ $producto->productoID }}">Mostrar producto</a></button>
                    <form action="/producto/delete/{{ $producto->productoID }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar producto">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan = "3">Sin registros</tr>
            </tr>
        @endforelse
    </table>
    <button id="botonInverso" class="pafuera"><a href="/producto/create">Agregar producto</a></button>
    <button id="botonInverso" class="pafuera"><a href="/login">Salir pa fuera</a></button>
@endsection