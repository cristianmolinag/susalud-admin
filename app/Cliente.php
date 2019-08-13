<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'cliente';

    protected $fillable = [
        'nombres', 'apellidos', 'correo', 'estado', 'password','documento', 'direccion', 'cod_postal', 'telefono'
    ];
}
