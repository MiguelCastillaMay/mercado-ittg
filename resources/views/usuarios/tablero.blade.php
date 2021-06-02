@extends('layout')

@section('title', 'Usuarios')

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
    {{ session('mensaje') }}
@endif
    <table>
        <tr>
            <th>Usuarios</th>
            <th>Acciones</th>
        </tr>
        @forelse ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->nombre }}</td>
                <td>
                    <button id="edit"><a href="/usuario/edit/{{ $usuario->usuarioID }}">Editar usuario</a></button>
                    <button id="show"><a href="/usuario/show/{{ $usuario->usuarioID }}">Mostrar usuario</a></button>
                    <form action="/usuario/delete/{{ $usuario->usuarioID }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar usuario">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan = "3">Sin registros</tr>
            </tr>
        @endforelse
    </table>
    <button id="botonInverso" class="pafuera"><a href="/usuario/create">Agregar usuario</a></button>
    <button id="botonInverso" class="pafuera"><a href="/login">Salir pa fuera</a></button>
@endsection