<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contrato';

    protected $fillable = [
        'estado', 'empleado_id', 'cargo_id'
    ];
}
