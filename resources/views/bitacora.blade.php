@extends('layout')

@section('title', 'Bitacora')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="/supervisor">Menú</a></li>
            <li><a href="/categoria">Categorías</a></li>
            <li><a href="/productos">Productos</a></li>
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