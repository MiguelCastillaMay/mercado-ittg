@extends('layout')

@section('title', 'Mercado ITTG')

@section('navBar')
<div class="menuBar">
    <h1>Mercado ITTG</h1>
    <ul>
        <li><a href="#">Categorías</a></li>
        <li><a href="#">Productos</a></li>
        <li><form action="/search" method="get" role="search">
            <input type="text" name="find" placeholder="Buscar productos">
            <button type="submit">Buscar</button>
        </form></li>
    </ul>
</div>
@endsection
    
@section('contenido')
    @if (session('mensaje'))
        <p>{{ session('mensaje') }}</p>
    @endif
    @isset($productos)
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
                        <button id="edit"><a href="/producto/edit/{{ $producto->id }}">Editar producto</a></button>
                        <button id="show"><a href="/producto/show/{{ $producto->id }}">Mostrar producto</a></button>
                        <form action="/producto/delete/{{ $producto->id }}" method="post">
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
    @endisset
@endsection