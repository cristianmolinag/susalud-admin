<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaFichaInsumo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_insumo', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('ficha_id');
            $table->foreign('ficha_id')->references('id')->on('ficha');

            $table->unsignedBigInteger('insumo_id');
            $table->foreign('insumo_id')->references('id')->on('insumo');

            $table->integer('cantidad');
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
        Schema::dropIfExists('ficha_insumo');
    }
}
