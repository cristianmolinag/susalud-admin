<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumo';

    protected $fillable = [
        'nombre',
        'medida',
        'proveedor_id',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function fichas()
    {
        return $this->belongsToMany(Ficha::class);
    }
}
