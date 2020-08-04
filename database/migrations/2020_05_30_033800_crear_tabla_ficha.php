<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaFicha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->unique();

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('producto');

            $table->unsignedBigInteger('talla_id');
            $table->foreign('talla_id')->references('id')->on('talla');

            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('color');

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('material');
            $table->longText('descripcion');
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('ficha');
    }
}
