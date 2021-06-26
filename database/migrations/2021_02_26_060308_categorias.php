<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Categorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function(Blueprint $table) {
            $table->id('categoriaID');
            $table->string('nombre', 100);
            $table->longText('descripcion');
            $table->longText('imagen');
            $table->boolean('activa');
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
