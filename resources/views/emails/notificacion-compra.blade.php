@extends('layout')

<style>
    * {
        font-family: "Montserrat", sans-serif;
    }
    .correo, h3 {
        width: fit-content;
        margin-right: auto;
        margin-left: auto;
    }
    .correo {
        border-style: solid;
        border-color: #1e212d;
        border-radius: 10px;
        margin: 15px;
        padding: 15px;
    }
</style>

@section('contenido')
    <div class="correo">
        <h2>{{ $nombre }} ({{ $correo }}) ha comprado su producto.</h2>
        <div class="detalles">
            <h3>Detalles de la compra</h3>
            <p>Producto: {{ $producto }}</p>
            <p>Cantidad: {{ $cantidad }}</p>
            <p>Precio: ${{ $precio }}</p>
            <p>Total: ${{ $total }}</p>
        </div>
    </div>
@endsection