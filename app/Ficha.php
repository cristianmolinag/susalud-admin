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
        'talla_id',
        'color_id',
        'material_id',
        'estado',
    ];

    public function insumos()
    {
        return $this->belongsToMany(Insumo::class);
    }

    public function procesos()
    {
        return $this->belongsToMany(Proceso::class);
    }
}
