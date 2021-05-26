@extends('layout')

@section('title', 'Editar categoría')

@section('contenido')
    <div id="cuadro">
        <form action="/categoria/edit/{{ $categoria->id }}" method="post">
            @csrf
            @method('PUT')
            <div id="form">
                <div>
                    <p>Nombre de la sección:</p>
                    <p>Descripción de la categoría:</p>
                </div>
                <div>
                    <input type="text" name="nombre" value="{{ $categoria->nombre }}">
                    <input type="text" name="desc" value="{{ $categoria->descripcion }}">
                </div>
            </div>
            <input type="submit" value="Editar" id="boton">
        </form>
    </div>
@endsection