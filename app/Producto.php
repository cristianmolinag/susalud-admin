<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';

    protected $fillable = [
        'imagen', 'precio', 'estado', 'nombre', 'material_id'
    ];
    
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function colores()
    {
        return $this->belongsToMany(Color::class);
    }

    public function tallas()
    {
        return $this->belongsToMany(Talla::class);
    }
    
}
