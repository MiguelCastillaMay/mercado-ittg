@extends('layout')

@section('title', 'Información General')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
    </div>
@endsection

@section('contenido')
    <div style="display: flex; flex-direction: row; justify-content: space-around;">
        <div>
            <p style="color: black; text-align: center;">Cantidad de usuarios registrados: {{ $conteoUsuarios }}</p>
        </div>
        <div>
            <p style="color: black; text-align: center;">Cantidad de transacciones: {{ $conteoAcciones }}</p>
        </div>
        <div>
            <p style="color: black; text-align: center;">Cantidad de productos: {{ $conteoProductos }}</p>
        </div>
    </div>
@endsection