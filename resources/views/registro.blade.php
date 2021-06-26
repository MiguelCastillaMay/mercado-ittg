@extends('layout')

@section('title', 'Registro')

@section('navBar')
    <div class="menuBar">
        <h1>Mercado ITTG</h1>
        <ul>
            <li><a href="/categoria">Categorías</a></li>
            <li><a href="/productos">Productos</a></li>
            <li><form action="/search" method="get" role="search">
                <input type="text" name="find" placeholder="Buscar productos">
                <input  type="submit" value="Buscar" id="botonInverso">
            </form></li>
            <li><a href="/login">Iniciar sesión</a></li>
        </ul>
    </div>
@endsection

<style>
    h2 {
        color: #1e212d;
        font-size: 1.7em;
        margin-bottom: 15px;
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
    input {
        color: #1e212d;
    }
    #email {
        display: flex;
        flex-direction: column;
    }
    span {
        color: aliceblue;
        margin-top: 10px;
        width: fit-content;
        padding: 3px;
    }
    .registro {
        display: block;
        width: fit-content;
        margin-top: 22.576px;
        margin-bottom: 22.576px;
        margin-right: auto;
        margin-left: auto;
    }
    .error {
        background-color: #810000;
        border-radius: 5px;
        border: 2px solid #810000;
    }
    .exito {
        background-color: #1cc25c;
        border-radius: 5px;
        border: 2px solid #1cc25c;
    }
    input[type=text], input[type=password] {
        border-radius: 5px;
        font-size: 17px;
    }
    h2.titulo {
        display: flex;
        justify-content: center;
        font-size: 2em;
        font-weight: 300;
        margin: 0px;
    }
    h2#mensaje {
        display: flex;
        justify-content: center;
    }
</style>

@section('contenido')
@if (session('error'))
    <h2 id="mensaje">{{ session('error') }}</h2>
@endif
    <div class="catalogo">
        <h2 class="titulo">Registro</h2>
        <form action="/usuario/store" method="post" enctype="multipart/form-data">
            @csrf
            <div class="nombre">
                <div id="nombre">
                    <h2>Nombre</h2>
                    <input type="text" name="nombre" value="">
                </div>
                <div id="apellidoP">
                    <h2>Apellido paterno</h2>
                    <input type="text" name="a_paterno" value="">
                </div>
                <div id="apellidoM">
                    <h2>Apellido materno</h2>
                    <input type="text" name="a_materno" value="">
                </div>
            </div>
            <div class="imagen">
                <h2>Seleccione una imagen</h2>
                <input type="file" name="imagen">
            </div>
            <div id="email">
                <h2>Correo</h2>
                <input type="text" name="correo" id="correo" value="">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#correo').blur(function() {
                var error = '';
                var correo = $('#correo').val();
                var _token = $('input[name="_token"]').val();
                var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

                if(!filter.test(correo)) {
                    $('#mensaje').html('<label>Dirección de correo inválida</label>');
                    $('#mensaje').remove('exito');
                    $('#mensaje').addClass('error');
                    $('#botonInverso').attr('disabled', 'disabled');
                } else {
                    $.ajax({
                        url: '/correo/check',
                        method: 'POST',
                        data: {correo:correo, _token:_token},
                        success: function(result) {
                            if (result == 'unique') {
                                $('#mensaje').html('<label>Correo disponible</label>');
                                $('#mensaje').removeClass('error');
                                $('#mensaje').addClass('exito');
                                $('#botonInverso').attr('disabled', false);
                            } else {
                                $('#mensaje').html('<label>Correo no disponible</label>');
                                $('#mensaje').removeClass('exito');
                                $('#mensaje').addClass('error');
                                $('#botonInverso').attr('disabled', 'disabled');
                            }
                        }
                    })
                }
            });
        })
    </script>
@endsection