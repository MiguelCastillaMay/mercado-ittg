@extends('layout')

@section('title', 'Mis propuestas')

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
    #botonInverso {
        font-weight: 100;
    }
    img {
        height: max-content;
        width: 35%;
    }
    form {
        display: inline;
    }
</style>

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="/categoria">Categorias</a></li>
            <li><a href="/productos">Productos</a></li>
            <li><form action="/search" method="get" role="search">
                <input type="text" name="find" placeholder="Buscar productos">
                <input  type="submit" value="Buscar" id="botonInverso">
            </form></li>
            <li><a href="/usuario/show/{{ Auth::User()->usuarioID }}">Mi perfil</a></li>
        </ul>
    </div>
@endsection

@section('contenido')
    @isset($propuestas)
        <div class="catalogo">
            @foreach ($propuestas as $propuesta)
                <div class="producto">
                    <img src="{{ url('storage/'.$propuesta->imagen) }}" alt="{{ $propuesta->nombre }}">
                    <div class="datosProducto">
                        <h1>{{ $propuesta->nombre }}</h1>
                        <p>{{ $propuesta->descripcion }}</p>
                        <p>${{ $propuesta->precio }}</p>
                        @if ($propuesta->activo == 1)
                            <p>Estado: Aceptado</p>
                        @elseif ($propuesta->activo==0 and $propuesta->rechazado == 0)
                            <p>Estado: En espera</p>
                            <a class="boton" href="/producto/edit/{{ $propuesta->productoID }}">Editar</a>
                            <form action="/producto/delete/{{ $propuesta->productoID }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="botonInverso">Eliminar</button>
                            </form>
                        @elseif ($propuesta->rechazado == 1)
                            <p>Estado: Rechazado</p>
                            <p>Razón de rechazo: {{ $propuesta->razon }}</P>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endisset

    <a class="boton pafuera" href="/salir">Salir pa fuera</a>
@endsection