<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    protected $table = 'ficha';

    protected $fillable = [
        'nombre',
        'descripcion',
        'producto_id',
        'talla',
        'color',
        'estado',
    ];

    public function insumos()
    {
        return $this->belongsToMany(Insumo::class)->withPivot(["cantidad"]);
    }

    public function procesos()
    {
        return $this->belongsToMany(Proceso::class)->withPivot(["orden"]);
    }
}
