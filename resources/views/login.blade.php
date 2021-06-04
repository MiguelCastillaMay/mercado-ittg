@extends('layout')

@section('title', 'Inicio de sesión')

@section('contenido')
    <div id="cuadro">
        <h1>Bienvenido</h1>
        @if (session('error'))
            {{ session('error') }}
        @elseif (session('mensaje'))
            {{ session('mensaje') }}
        @endif
        <form action="/validar" method="get">
            <div id="form">
                <div>
                    <p>Usuario: </p>
                    <p>Contraseña: </p>
                </div>
                <div>
                    <input type="text" name="usuario">
                    <input type="password" name="contra">
                </div>
            </div>
            <input type="submit" value="Ingresar" id="botonInverso">
            <button id="botonInverso"><a href="/registro">Registrarte</a></button>
        </form>
        <button id="botonInverso"><a href="/">Olvidé mi contraseña</a></button>
    </div>
@endsection