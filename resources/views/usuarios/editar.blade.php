@extends('layout')

@section('title', 'Editar usuario')

@php
    $usuarioLog = Auth::User();
@endphp
    
@section('contenido')
    <div id="cuadro">
        <form action="/usuario/edit/{{ $usuario->usuarioID }}" method="post" enctype="multipart/form-data">
            @if (session('error'))
                <p>{{ session('error') }}</p>
            @endif
            @csrf
            @method('PUT')
            <div id="form">
                <div>
                    <p>Nombre:</p>
                    <p>Apellido paterno:</p>
                    <p>Apellido materno:</p>
                    <p>Correo:</p>
                    <p>Imagen:</p>
                    <p>Tipo de usuario:</p>
                    <p>Contraseña:</p>
                    <p>Repita la contraseña</p>
                </div>
                <div>
                    <input type="text" name="nombre" value="{{ $usuario->nombre }}">
                    <input type="text" name="a_paterno" value="{{ $usuario->a_paterno }}">
                    <input type="text" name="a_materno" value="{{ $usuario->a_materno }}">
                    <input type="text" name="correo" value="{{ $usuario->correo }}">
                    <input type="file" name="imagen">
                    @if ($usuarioLog->rol == 'Cliente')
                        <select name="rol">
                            <option selected>Cliente</option>
                        </select>
                    @elseif ($usuarioLog->rol == 'Contador')
                        <select name="rol">
                            <option selected>Contador</option>
                        </select>
                    @elseif ($usuarioLog->rol == 'Encargado')
                        <select name="rol">
                            <option selected>Encargado</option>
                        </select>
                    @elseif ($usuarioLog->rol == 'Supervisor' or $usuarioLog->rol == 'Revisor')
                        <select name="rol">
                            @if ($usuario->rol == 'Supervisor')
                                <option selected>Supervisor</option>
                            @else
                                <option>Supervisor</option>
                            @endif
                            @if ($usuario->rol == 'Encargado')
                                <option selected>Revisor</option>
                            @else
                                <option>Revisor</option>
                            @endif
                            @if ($usuario->rol == 'Contador')
                                <option selected>Contador</option>
                            @else
                                <option>Contador</option>
                            @endif
                            @if ($usuario->rol == 'Cliente')
                                <option selected>Cliente</option>
                            @else
                                <option>Cliente</option>
                            @endif
                            @if ($usuario->rol == 'Revisor')
                                <option selected>Revisor</option>
                            @else
                                <option>Revisor</option>
                            @endif
                        </select>
                    @endif
                    <input type="password" name="password">
                    <input type="password" name="password2">
                </div>
            </div>
            <input type="submit" value="Editar" id="boton">
        </form>
    </div>
@endsection