@extends('layout')

@section('title', 'Editar producto')
    
@section('contenido')
    <div id="cuadro">
        <form action="/producto/edit/{{ $producto->productoID }}" method="post">
            @csrf
            @method('PUT')
            <div id="form">
                <div>
                    <p>Nombre del producto:</p>
                    <p>Descripción del producto:</p>
                </div>
                <div>
                    <input type="text" name="nombre" value="{{ $producto->nombre }}">
                    <input type="text" name="desc" value="{{ $producto->descripcion }}">
                </div>
            </div>
            <input type="submit" value="Editar" id="boton">
        </form>
    </div>
@endsection