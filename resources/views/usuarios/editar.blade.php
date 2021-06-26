@extends('layout')

@section('title', 'Editar usuario')

@php
    $usuarioLog = Auth::User();
@endphp

@section('navBar')
    <div class="menuBar">
        <h1>Mercado ITTG</h1>
        <ul>
            <li><a href="/categoria">Categorías</a></li>
            <li><a href="/productos">Productos</a></li>
            @if (is_null($usuarioLog) or $usuarioLog->rol == 'Cliente')
                <li><form action="/search" method="get" role="search">
                    <input type="text" name="find" placeholder="Buscar productos">
                    <input  type="submit" value="Buscar" id="botonInverso">
                </form></li>
            @elseif ($usuarioLog->rol == 'Supervisor' or $usuarioLog->rol == 'Revisor')
                <li><a href="/productos">Bitácora</a></li>
            @endif
            @if (is_null($usuarioLog))
                <li><a href="/login">Iniciar sesión</a></li>
            @elseif ($usuarioLog->rol == 'Cliente')
                <li><a href="/usuario/show/{{ $usuarioLog->usuarioID }}">Mi perfil</a></li>
            @endif
        </ul>
    </div>
@endsection

<style>
    .catalogo {
        padding-left: 19.920px;
        padding-right: 19.920px;
        background-color: aliceblue;
        border-color: #1e212d;
        border-style: solid;
        border-radius: 30px;
        border-width: 5px;
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
    }
    .passwords{
        display: flex;
        justify-content: space-around;
    }
    .nombre {
        display: flex;
    }
    #apellidoP {
        margin-left: 30px;
        margin-right: 30px;
    }
    #nombre, #apellidoP, #apellidoM {
        width: 33%;
    }
    #nombre > input, #apellidoP > input,
    #apellidoM > input {
        width: -webkit-fill-available;
    }    #contra1, #contra2 {
        width: 50%;
    }
    #contra1 > input, #contra2 > input {
        width: 80%;
    }
    #email > input {
        width: 40%;
    }
    input, h2 {
        color: #1e212d;
    }
    #email {
        display: flex;
        flex-direction: column;
    }
    h2.titulo {
        display: flex;
        justify-content: center;
        font-size: 2em;
        font-weight: 300;
        margin: 0px;
    }
    input[type=text], input[type=number], input[type=file], input[type=password] {
        border-radius: 5px;
        font-size: 17px;
        border-width: 1px;
        color: #1e212d;
        font-family: "Montserrat", sans-serif;
        font-weight: 400;
    }
    input[type=file] {
        border-radius: 0px;
    }
    .registro {
        margin-top: 30px;
        display: block;
        margin-right: auto;
        margin-left: auto;
    }
</style>
    
@section('contenido')
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif
    <div class="catalogo" style="padding-bottom: 40px;">
        <h2 class="titulo">Editar perfil</h2>
        <form action="/usuario/edit/{{ $usuario->usuarioID }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="nombre">
                <div id="nombre">
                    <h2>Nombre</h2>
                    <input type="text" name="nombre" value="{{ $usuario->nombre }}">
                </div>
                <div id="apellidoP">
                    <h2>Apellido paterno</h2>
                    <input type="text" name="a_paterno" value="{{ $usuario->a_paterno }}">
                </div>
                <div id="apellidoM">
                    <h2>Apellido materno</h2>
                    <input type="text" name="a_materno" value="{{ $usuario->a_materno }}">
                </div>
            </div>
            <div class="imagen">
                <h2>Seleccione una imagen</h2>
                <input type="file" name="imagen">
            </div>
            <div id="email">
                <h2>Correo</h2>
                <input type="text" name="correo" value="{{ $usuario->correo }}">
                <span id="mensaje"></span>
            </div>
            <div class="passwords">
                <div id="contra1">
                    <h2>Contraseña</h2>
                    <input type="password" name="password" id="password">
                </div>
                <div id="contra2">
                    <h2>Confirme su contraseña</h2>
                    <input type="password" name="password2" id="password2">
                </div>
            </div>
            <input class="registro" type="submit" value="Registrarse" id="botonInverso">
        </form>
    </div>
@endsection