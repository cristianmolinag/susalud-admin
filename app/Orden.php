<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orden';

    protected $fillable = [
        'ficha_id',
        'pedido_id',
        'estado',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
