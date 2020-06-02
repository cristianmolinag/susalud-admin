<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFichaProceso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_proceso', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('ficha_id');
            $table->foreign('ficha_id')->references('id')->on('ficha');

            $table->unsignedBigInteger('proceso_id');
            $table->foreign('proceso_id')->references('id')->on('proceso');

            $table->integer('orden');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ficha_proceso');
    }
}
