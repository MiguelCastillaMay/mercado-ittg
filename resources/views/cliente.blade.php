@extends('layout')

@section('tittle', 'Cliente')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="#">Menú</a></li>
            <li><a href="#">Categorías</a></li>
            <li><a href="#">Ofertas</a></li>
            <li><a href="/usuario/show/{{ $usuario->usuarioID }}">Mi perfil</a></li>
            <li><a href="#">Mi carrito</a></li>
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
    <a href="/login"><button id="botonInverso" class="pafuera">Salir pa fuera</button></a>
@endsection