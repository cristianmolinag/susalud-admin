<?php

namespace App\Modelos;

class FichaProceso
{
    public $proceso_id;
    public $proceso_nombre;
    public $seleccionado;
    public $orden;

    public function __constuct($proceso_id, $proceso_nombre, $seleccionado, $orden)
    {
        $this->proceso_id = $proceso_id;
        $this->proceso_nombre = $proceso_nombre;
        $this->orden = $orden;
        $this->seleccionado = $seleccionado;
    }
}
