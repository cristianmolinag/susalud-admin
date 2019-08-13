<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{

    protected $table = 'color';

    protected $fillable = [
        'nombre', 'estado',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'detalle_pedido');
    }
}
