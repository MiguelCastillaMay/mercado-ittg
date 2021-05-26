<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30);
            $table->string('a_paterno', 20);
            $table->string('a_materno', 20);
            $table->string('correo', 45);
            $table->string('imagen', 100);
            $table->enum('rol', ['Supervisor', 'Encargado', 'Contador', 'Cliente']);
            $table->boolean('activo');
            $table->string('password', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
