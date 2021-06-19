@extends('layout')

@section('title', 'Nuevo producto')
    
@section('contenido')
<div id="cuadro">
    <h1>Agregar un producto nuevo</h1>
    <form action="/producto/store" method="post" enctype="multipart/form-data">
        @csrf
        <div id="form">
            <div>
                <p>Nombre del producto:</p>
                <p>Descripción del producto:</p>
                <p>Categoría: </p>
                <p>Precio: </p>
                <p>Cantidad: </p>
                <p>Imagen: </p>
            </div>
            <div>
                <input type="text" name="nombre" value="">
                <input type="text" name="desc" value="">
                <select name="categoria">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->categoriaID }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                <input type="number" name="precio" value="0">
                <input type="number" name="cantidad" value="1">
                <input type="file" name="imagen">
            </div>
        </div>
        <input type="submit" value="Agregar" id="boton">
    </form>
</div>
@endsection