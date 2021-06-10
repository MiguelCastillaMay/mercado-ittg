@extends('layout')

@section('title', 'Propuestas')

@section('navBar')
    <div class="menuBar">
        <h1>TiendaFicticia.com</h1>
    </div>
@endsection
    
@section('contenido')
        <div id="cuadro">
            <form action="/propuesta/rechazar/{{ $propuesta->productoID }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div id="form">
                    <div>
                        <p>Razón:</p>
                    </div>
                    <div>
                        <textarea name="razon" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <input type="submit" value="Rechazar" id="boton">
            </form>
        </div>
        
        <button id="botonInverso" class="pafuera"><a href="/salir">Salir pa fuera</a></button>
@endsection