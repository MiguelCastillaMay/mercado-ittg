@extends('layout')

@section('tittle', 'Error')

@section('contenido')
    <div id="cuadro">
        <h1>
            Error: Usuario o contraseña incorrectos.
        </h1>
        <a href="/login"><input type="button" value="Regresar" id="boton"></a>
    </div>
@endsection