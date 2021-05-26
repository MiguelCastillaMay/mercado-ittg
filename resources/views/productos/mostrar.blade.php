@extends('layout')

@section('title', 'Mostrar')
    
@section('contenido')
<div id="cuadro">
    <h1>{{ $producto->nombre }}</h1>
    <p>{{ $producto->descripcion }}</p>
</div>
@endsection