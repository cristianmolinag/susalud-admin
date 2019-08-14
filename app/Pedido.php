<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';

    protected $fillable = [
        'observaciones',
        'estado',
        'cliente_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_pedido')->with('material')
            ->withPivot('cantidad', 'precio_unitario', 'precio_total', 'talla', 'color');
    }
}
