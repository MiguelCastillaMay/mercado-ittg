@extends('layout')

@section('title', 'Categoráas')

@section('navBar')
<div class="menuBar">
    <h1>Mercado ITTG</h1>
    <ul>
        <li><a href="#">Categorías</a></li>
        <li><a href="#">Productos</a></li>
        <li><form action="/search" method="get" role="search">
            <input type="text" name="find" placeholder="Buscar productos">
            <button type="submit">Buscar</button>
        </form></li>
        <li><a href="/login">Iniciar sesión</a></li>
    </ul>
</div>
@endsection
    
@section('contenido')
    
@endsection