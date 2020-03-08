<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{   
    protected $table = 'proveedor';

    protected $fillable = [
        'nit', 'nombre', 'direccion', 'telefono', 'estado'
    ];
}
