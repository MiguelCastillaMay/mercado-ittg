@extends('layout')

@section('title', 'Propuestas')

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
    
    a.boton:hover, input.boton {
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
    textarea {
        resize: none;
        display: block;
        margin-right: auto;
        margin-left: auto;
    }
    h2 {
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
        color: #1e212d;
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
<h2>{{session('error')}}</h2>
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
                                <p>Razón de rechazo:</p>
                                <textarea name="razon" cols="50" rows="10"></textarea>
                                <input class="boton" type="submit" value="Rechazar">
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