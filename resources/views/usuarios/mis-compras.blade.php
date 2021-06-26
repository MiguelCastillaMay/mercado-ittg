@extends('layout')

@section('title', 'Mis compras')

<style>
    h2, h3 {
        color: #1e212d;
        display: flex;
        justify-content: center;
        margin-top: 80px;
    }
    #botonInverso {
        font-weight: 100;
    }
    img {
        height: max-content;
        width: 35%;
    }
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
    button#botonInverso {
        font-size: 20px;
    }
    form > div {
        display: flex;
    }
    form > div > #evidencia {
        color: #1e212d;
    }
    #mensaje {
        margin-top: 19.920px;
        margin-bottom: 40px;
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
    @if (session('mensaje'))
        <h2 id="mensaje">{{ session('mensaje') }}</h2>
    @endif
    <div class="catalogo">
        @forelse ($compras as $compra)
            <div class="producto">
                <img src="{{ url('storage/'.$compra->imagen) }}" alt="{{ $compra->nombre }}">
                <div class="datosProducto">
                    <h1>{{ $compra->nombre }}</h1>
                    <p>{{ $compra->descripcion }}</p>
                    <p>${{ $compra->precio }}. MXN C/U</p>
                    <p>Cantidad comprada: {{ $compra->cantidad }}</p>
                    <p>Total: {{ $compra->total }}</p>
                    <p>Fecha de compra: {{ $compra->fecha }}</p>
                </div>
                <div>
                    @if (is_null($compra->evidencia))
                        <form action="/evidencia/{{ $compra->ventaID }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h3>Agregar evidencia de pago</h3>
                            <div>
                                <input id="evidencia" type="file" name="evidencia">
                                <button id="botonInverso" type="submit">Agregar</button>
                            </div>
                        </form>
                    @endif
                    <form action="/rating/{{$compra->ventaID}}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <h3>Calificar el producto</h3>
                        <select name="Calificar">
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                            <option value="3"> 3 </option>
                            <option value="4"> 4 </option>
                            <option value="5"> 5 </option>
                        </select>
                        <button id="botonInverso" type="submit">Calificar</button>
                    </form>
                </div>
            </div>
        @empty
            <h2>No has comprado nada aún.</h2>
        @endforelse
    </div>
    <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
@endsection