@extends('layout')

@section('title', 'Detalles de producto')

@php
    $usuarioAuth = Auth::User()
@endphp
    
@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
    </div>
@endsection

@section('contenido')
    <div id="cuadro">
        <img src="{{ url('storage/'.$pago->evidencia) }}">
        <h1>Nombre del producto{{--{{ $pago->nombre }}--}}</h1> 
        <p>Concepto</p>
        <p>No. del pago: {{$pago->pagoID}}</p>
        <p>Vendedor: {{-- $ventas --}}</p>
        <p>Comprador: {{-- $producto->created_at --}}</p>
        <p>Fecha de la compra: {{-- $producto->created_at --}}</p>
        <form action="/pago/validar/{{ $pago->pagoID }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="submit" value="Validar" id="boton">
        </form>
    </div>
@endsection