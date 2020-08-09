<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaHistoricoOrden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_orden', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('orden_id');
            $table->foreign('orden_id')->references('id')->on('orden');

            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleado');

            $table->string('estado');

            $table->dateTime('fecha_fin', 0)->nullable();

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
        Schema::dropIfExists('historico_orden');
    }
}
