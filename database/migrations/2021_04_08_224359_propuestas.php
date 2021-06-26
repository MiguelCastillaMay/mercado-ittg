<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Propuestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuestas', function(Blueprint $table){
            $table->id('propuestaID');
            $table->unsignedBigInteger('productoID');
            $table->foreign('productoID')->references('productoID')->on('productos');
            $table->boolean('rechazado');
            $table->longText('razon')->nullable;
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
