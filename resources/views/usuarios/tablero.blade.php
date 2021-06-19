@extends('layout')

@section('title', 'Usuarios')

<style>
    a.boton, input.boton {
        -webkit-appearance: button;
        -moz-appearance: button;
        appearance: button;
        background-color: #1e212d;
        border-style: solid;
        border-color: #1e212d;
        font-size: 25px;
        padding: 10px;
        border-radius: 15px;
        color: #f0f8ff;
        transition-duration: 0.4s;
        cursor: pointer;
        font-family: "Montserrat", sans-serif;
        margin-bottom: 10px;
    }
    
    a.boton:hover, input.boton:hover {
        background-color: #f0f8ff;
        color: #1e212d;
    }
    .pafuera {
        display: block;
        width: fit-content;
        margin-top: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    a.opciones, input.opciones {
        font-weight: 100;
        font-size: 15px;
        display: inline;
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
    }
    form {
        display: inline;
        margin: 0px;
    }
    #botones {
        padding-top: 10px;
    }
</style>

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
                    <td id="botones">
                        <a class="boton opciones" href="/usuario/edit/{{ $usuario->usuarioID }}">Editar usuario</a>
                        <a class="boton opciones" href="/usuario/show/{{ $usuario->usuarioID }}">Mostrar usuario</a>
                        <form action="/usuario/delete/{{ $usuario->usuarioID }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input class="boton opciones" type="submit" value="Eliminar usuario">
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan = "3">Sin registros</tr>
                </tr>
            @endforelse
        </table>
        <a class="boton pafuera" href="/usuario/create">Agregar usuario</a>
        <a class="boton pafuera" href="/salir">Salir pa fuera</a>
@endsection