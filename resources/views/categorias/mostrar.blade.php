@extends('layout')

@section('title', 'Mostrar')
    
@section('contenido')
    <div id="cuadro">
        <h1>Esta cateogria es la de {{ $categoria->nombre }}</h1>
    </div>
@endsection