<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;


class AutenticarController extends Controller
{
    public function validar(Request $request) {
        $nombre = $request->input('usuario');
        $usuario = Usuario::where('nombre', $nombre)->first();
        if(is_null($usuario))
            return redirect('/login')->with('error', 'Datos incorrectos');
        else {
            $password = $request->input('contra');
            $password_bd = $usuario->password;
            if(Hash::check($password, $password_bd)) {
                //si las contraseñas son iguales 
                Auth::login($usuario);
                switch ($usuario->rol) {
                    case 'Cliente':
                        return redirect('/');
                        break;
        
                    case 'Supervisor':
                        return redirect('/supervisor');
                        break;
                    
                    case 'Revisor':
                        return redirect('/revisor');
                        break;

                    default:
                        return view('errorLogin');
                        break;
                }
            }
            else {
                return redirect('/login')->with('error', 'Datos incorrectos');
            }
        }
    }

    public function salir() {
        Auth::logout();
        return redirect('/');
    }
}
