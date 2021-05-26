@extends('layout')

@section('title', 'Registro')

@section('contenido')
    <div id="cuadro">
        <form action="/usuario/store" method="post" enctype="multipart/form-data">
            @csrf
            <div id="form">
                <div>
                    <p>Nombre:</p>
                    <p>Apellido paterno:</p>
                    <p>Apellido materno:</p>
                    <p>Correo:</p>
                    <p>Imagen:</p>
                    <p>Contraseña:</p>
                    <p>Repita la contraseña</p>
                </div>
                <div id="inputs">
                    <input type="text" name="nombre" value="">
                    <input type="text" name="a_paterno" value="">
                    <input type="text" name="a_materno" value="">
                    <input type="text" name="correo" value="">
                    <input type="file" name="imagen">
                    <input type="password" name="password">
                    <input type="password" name="password2">
                </div>
            </div>
            <input type="submit" value="Registrarse" id="botonInverso">
        </form>
    </div>
@endsection