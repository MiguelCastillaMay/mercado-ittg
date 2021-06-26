<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Preguntas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id('preguntaID');
            $table->unsignedBigInteger('productoID');
            $table->foreign('productoID')->references('productoID')->on('productos');
            $table->unsignedBigInteger('compradorID');
            $table->foreign('compradorID')->references('usuarioID')->on('usuarios');
            $table->string('pregunta', 300);
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
