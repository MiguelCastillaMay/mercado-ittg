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
                <p>Imagen</p>
            </div>
            <div>
                <input type="text" name="nombre" value="">
                <input type="text" name="desc" value="">
                <input type="file" name="imagen">
            </div>
        </div>
        <input type="submit" value="Agregar" id="boton">
    </form>
</div>
@endsection