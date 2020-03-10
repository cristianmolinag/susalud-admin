<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Empleado extends Authenticatable
{
    use Notifiable, HasRoles;
    protected $table = 'empleado';

    protected $fillable = [
        'nombres',
        'correo',
        'password',
    ];

    public function getCargoAttribute()
    {
        return $this->cargos->first(); // not addresses()->first(); as it would run the query everytime
    }

    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'contrato')->withTimestamps()->wherePivot('estado', 1);
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
