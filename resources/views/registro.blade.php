@extends('layout')

@section('title', 'Registro')

<style>
</style>

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
                    <input type="text" name="correo" id="correo" value="">
                    <span id="error"></span>
                    <input type="file" name="imagen">
                    <input type="password" name="password" id="password">
                    <input type="password" name="password2" id="password2">
                </div>
            </div>
            <input type="submit" value="Registrarse" id="botonInverso">
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
                    $('#error').html('<label>Dirección de correo inválida</label>');
                    $('#botonInverso').attr('disabled', 'disabled');
                } else {
                    $.ajax({
                        url: '/correo/check',
                        method: 'POST',
                        data: {correo:correo, _token:_token},
                        success: function(result) {
                            if (result == 'unique') {
                                $('#error').html('<label>Correo disponible</label>');
                                $('#error').removeClass('error');
                                $('#botonInverso').attr('disabled', false);
                            } else {
                                $('#error').html('<label>Correo no disponible</label>');
                                $('#error').addClass('error');
                                $('#botonInverso').attr('disabled', 'disabled');
                            }
                        }
                    })
                }
            });
        })
    </script>
@endsection