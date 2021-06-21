<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function(Blueprint $table) {
            $table->id('pagoID');
            $table->unsignedBigInteger('ventaID');
            $table->foreign('ventaID')->references('ventaID')->on('ventas');
            $table->longText('evidencia');
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
