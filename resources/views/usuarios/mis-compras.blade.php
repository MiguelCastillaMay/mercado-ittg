@extends('layout')

@section('title', 'Mis compras')

<style>
    h2 {
        color: #1e212d;
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }
    #botonInverso {
        font-weight: 100;
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
                <button type="submit">Buscar</button>
            </form></li>
            <li><a href="/usuario/show/{{ Auth::User()->usuarioID }}">Mi perfil</a></li>
        </ul>
    </div>
@endsection

@section('contenido')
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
                    <p id=>Calificar producto: </p>
                    <div>
                        <form action="/rating/{{$compra->ventaID}}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PUT')                
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
            </div>
        @empty
            <h2>No has comprado nada aún.</h2>
        @endforelse
    </div>
    <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
@endsection