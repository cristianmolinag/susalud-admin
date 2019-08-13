<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table = 'talla';

    protected $fillable = [
        'nombre', 'estado',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }
}
