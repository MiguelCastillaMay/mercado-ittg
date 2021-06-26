<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function(Blueprint $table) {
            $table->id('productoID');
            $table->unsignedBigInteger('categoriaID');
            $table->foreign('categoriaID')->references('categoriaID')->on('categorias');
            $table->unsignedBigInteger('usuarioID');
            $table->foreign('usuarioID')->references('usuarioID')->on('usuarios');
            $table->string('nombre', 100);
            $table->longText('descripcion');
            $table->longText('imagen');
            $table->integer('precio');
            $table->integer('cantidad');
            $table->boolean('activo');
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
