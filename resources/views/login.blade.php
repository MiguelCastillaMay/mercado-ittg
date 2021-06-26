@extends('layout')

@section('title', 'Inicio de sesión')

<style>
    a.boton {
        -webkit-appearance: button;
        -moz-appearance: button;
        appearance: button;
        background-color: #1e212d;
        border-style: solid;
        border-color: #1e212d;
        font-size: 25px;
        padding: 10px;
        border-radius: 15px;
        color: #f0f8ff;
        transition-duration: 0.4s;
        cursor: pointer;
        font-family: "Montserrat", sans-serif;
        margin-bottom: 10px;
    }
    
    a.boton:hover {
        background-color: #f0f8ff;
        color: #1e212d;
    }
    input[type=text], input[type=password] {
        font-size: 20px;
    }
</style>

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
            <a class="boton" href="/registro">Registrarte</a>
        </form>
        <a class="boton" href="/">Olvidé mi contraseña</a>
    </div>
@endsection