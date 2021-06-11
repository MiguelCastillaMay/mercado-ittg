@extends('layout')

@section('title', 'Mis compras')

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
    @isset($compras)
        <div class="catalogo">
            @foreach ($compras as $compra)
                <div class="producto" style="margin-bottom: 0px">
                    <img src="{{ url('storage/'.$compra->imagen) }}" alt="{{ $compra->nombre }}">
                    <div class="datosProducto">
                        <h1>{{ $compra->nombre }}</h1>
                        <p>{{ $compra->descripcion }}</p>
                        <p>${{ $compra->precio }}. MXN C/U</p>
                        <p>Cantidad comprada: {{ $compra->cantidad }}</p>
                        <p>Total: {{ $compra->total }}</p>
                        <p>Fecha de compra: {{ $compra->fecha }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endisset
    <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
@endsection