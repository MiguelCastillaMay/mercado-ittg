<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function(Blueprint $table) {
            $table->id('usuarioID');
            $table->string('nombre', 100);
            $table->string('a_paterno', 100);
            $table->string('a_materno', 100);
            $table->string('correo', 100);
            $table->longText('imagen');
            $table->enum('rol', ['Supervisor', 'Encargado', 'Revisor', 'Cliente', 'Contador']);
            $table->boolean('activo');
            $table->string('password', 100);
            $table->timestamps($precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
