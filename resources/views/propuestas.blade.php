@extends('layout')

@section('title', 'Propuestas')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
    </div>
@endsection

@section('contenido')
    <table>
        <tr>
            <th>Comprador</th>
            <th>Vendedor</th>
            <th>Articulo</th>
            <th>Fecha</th>
            <th>Precio unitario</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
       {{--   @foreach ($transacciones as $transaccion)
            <tr>
                <td>{{ $transaccion->comprador }}</td>
                <td>{{ $transaccion->vendedor }}</td>
                <td>{{ $transaccion->articulo }}</td>
                <td>{{ $transaccion->fecha }}</td>
                <td>{{ $transaccion->precioUnitario }}</td>
                <td>{{ $transaccion->cantidad }}</td>
                td>{{ $transaccion->total }}</td>
            </tr>
        @endforeach --}}
    </table>
@endsection