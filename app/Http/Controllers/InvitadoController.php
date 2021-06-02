<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class InvitadoController extends Controller
{
    public function categorias() {
        $categorias = Categoria::all();
        return view('categorias.guest.ver-categorias', compact('categorias'));
    }
}
