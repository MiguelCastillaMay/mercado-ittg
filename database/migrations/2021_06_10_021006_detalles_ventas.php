<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetallesVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_ventas', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('productoID');
            $table->foreign('productoID')->references('productoID')->on('productos');
            $table->unsignedBigInteger('compradorID');
            $table->foreign('compradorID')->references('usuarioID')->on('usuarios');
            $table->unsignedBigInteger('ventaID');
            $table->foreign('ventaID')->references('ventaID')->on('ventas');
            $table->integer('cantidad');
            $table->integer('precio');
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
