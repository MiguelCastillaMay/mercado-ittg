@extends('layout')

@section('title', 'Propuestas')

<style>
    a.boton {
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
    
    a.boton:hover {
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
                            <a class="boton" href="/propuesta/aceptar/{{ $propuesta->productoID }}">Aceptar</a></button>
                            <form action="/propuesta/rechazar/{{ $propuesta->productoID }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="submit" value="Rechazar" id="show">
                                    <div>
                                        <p>Razón de rechazo:</p>
                                    </div>
                                    <div>
                                        <textarea name="razon" cols="30" rows="10"></textarea>
                                    </div>
                            </form>
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