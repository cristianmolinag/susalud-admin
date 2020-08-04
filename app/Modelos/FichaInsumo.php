<?php

namespace App\Modelos;

class FichaInsumo
{
    public $insumo_id;
    public $insumo_nombre;
    public $insumo_medida;
    public $seleccionado;
    public $cantidad;

    public function __constuct(
        $insumo_id,
        $insumo_nombre,
        $insumo_medida,
        $seleccionado,
        $cantidad
    ) {
        $this->insumo_id = $insumo_id;
        $this->insumo_nombre = $insumo_nombre;
        $this->insumo_medida = $insumo_medida;
        $this->seleccionado = $seleccionado;
        $this->cantidad = $cantidad;
    }
}
