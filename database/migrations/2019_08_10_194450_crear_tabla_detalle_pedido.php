<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDetallePedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 13, 2);
            $table->decimal('precio_total', 13, 2);
            $table->string('talla');
            $table->string('color');

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('producto');

            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedido');

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
        Schema::dropIfExists('detalle_pedido');
    }
}
