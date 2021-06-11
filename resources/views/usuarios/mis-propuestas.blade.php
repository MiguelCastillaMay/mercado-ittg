@extends('layout')

@section('title', 'Mis propuestas')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
        <ul>
            <li><a href="/categoria">Categorias</a></li>
            <li><a href="/productos">Productos</a></li>
            <li><form action="/search" method="get" role="search">
                <input type="text" name="find" placeholder="Buscar productos">
                <button type="submit">Buscar</button>
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
                        @elseif ($propuesta->rechazado == 1)
                            <p>Estado: Rechazado</p>
                            <p>Razón de rechazo: {{ $propuesta->razon }}</P>
                        @endif
                        <button id="botonInverso"><a href="/producto/edit/{{ $propuesta->productoID }}">Editar</a></button>
                        <form action="/producto/delete/{{ $propuesta->productoID }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar" id="boton">
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endisset

    <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
@endsection