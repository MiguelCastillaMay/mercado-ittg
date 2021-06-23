<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EmailAvailable extends Controller
{
    public function check(Request $request) {
        if ($request->get('correo')) {
            $correo = $request->get('correo');
            $data = DB::table('usuarios')->where('correo', $correo)->count();

            if ($data > 0) {
                echo 'not unique';
            } else {
                echo 'unique';
            }
        }
    }
}
