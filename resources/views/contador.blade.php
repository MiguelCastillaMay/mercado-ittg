@extends('layout')

@section('title', 'Contador')

@section('navBar')
    <div class="menuBar">
        <h1>Mercado ITTG</h1>
    </div>
@endsection

@section('contenido')
    <div id="opcionesSupervisor">
        <a href="/ver-pagos"><button id="botonInverso">Ver pagos</button></a>
        <a href="/entregar-pagos"><button id="botonInverso">Entregar pagos</button></a>
    </div>
    <a href="/salir"><button id="botonInverso" class="pafuera">Salir pa fuera</button></a>
@endsection