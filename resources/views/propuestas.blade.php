@extends('layout')

@section('title', 'Propuestas')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="/supervisor">Menú</a></li>
            <li><a href="/categoria">Categorías</a></li>
            <li><a href="/productos">Productos</a></li>
            <li><a href="/bitacora">Bitácora</a></li>
        </ul>
    </div>
@endsection
    
@section('contenido')
        <table>
            <tr>
                <th>Productos</th>
                <th>Acciones</th>
            </tr>
            @isset($propuestas)
                @forelse ($propuestas as $propuesta)
                    <tr>
                        <td>{{ $propuesta->nombre }}</td>
                        <td>
                            <button id="edit"><a href="/propuesta/aceptar/{{ $propuesta->productoID }}">Aceptar</a></button>
                            <button id="show"><a href="/propuesta/rechazar/{{ $propuesta->productoID }}">Rechazar</a></button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan = "3">Sin registros</tr>
                    </tr>
                @endforelse
            @endisset
        </table>
        
        <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
@endsection