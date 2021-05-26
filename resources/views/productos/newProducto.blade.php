@extends('layout')

@section('title', 'Nuevo producto')
    
@section('contenido')
<div id="cuadro">
    <h1>Agregar un producto nuevo</h1>
    <form action="/producto/store" method="post">
        @csrf
        <div id="form">
            <div>
                <p>Nombre del producto:</p>
                <p>Descripción del producto:</p>
            </div>
            <div>
                <input type="text" name="nombre" value="">
                <input type="text" name="desc" value="">
            </div>
        </div>
        <input type="submit" value="Agregar" id="boton">
    </form>
</div>
@endsection