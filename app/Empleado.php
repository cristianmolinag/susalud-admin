<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;



class Empleado extends Authenticatable
{
    use Notifiable, HasRoles;
    protected $table = 'empleado';

    protected $fillable = [
        'nombres',
        'apellidos',
        'correo',
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
}
