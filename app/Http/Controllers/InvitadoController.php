<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class InvitadoController extends Controller
{
    public function categorias() {
        $categorias = Categoria::Activas()->get();
        return view('invitado.ver-categorias', compact('categorias'));
    }
}
