<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBitacora extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();
            $table->string('quien');
            $table->timestamp('cuando');
            $table->string('accion');
            $table->string('que');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitacora');
    }
}
