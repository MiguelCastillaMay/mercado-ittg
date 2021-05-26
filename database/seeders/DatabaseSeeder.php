<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nombre' => 'Miguel Angel',
            'a_paterno' => 'Castilla',
            'a_materno' => 'May',
            'correo' => 'miguelcastilla50@gmail.com',
            'imagen' => 'archivo.jpg',
            'rol' => 'Supervisor',
            'activo' => 1,
            'password'=> '1234',
        ]);
    }
}
