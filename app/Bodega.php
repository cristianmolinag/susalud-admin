<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    protected $table = 'bodega';

    protected $fillable = [
        'cantidad',
        'insumo_id',
    ];

    public function insumo()
    {
        return $this->belongsTo(Insumo::class)->with('proveedor');
    }
}
