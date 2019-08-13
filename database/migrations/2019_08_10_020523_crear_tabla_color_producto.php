<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaColorProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_producto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('color');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('producto');
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
        Schema::dropIfExists('color_producto');
    }
}
