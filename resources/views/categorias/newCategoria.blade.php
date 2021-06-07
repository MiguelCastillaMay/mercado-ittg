@extends('layout')

@section('title', 'Nueva categoria')
    
@section('contenido')
    <div id="cuadro">
        <h1>Agregar una nueva categoría</h1>
        <form action="/categoria" method="post">
            @csrf
            <div id="form">
                <div>
                    <p>Nombre de la categoría:</p>
                    <p>Descripción de la categoría:</p>
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