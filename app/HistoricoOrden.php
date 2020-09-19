<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoOrden extends Model
{
    protected $table = 'historico_orden';

    protected $fillable = [
        'orden_id',
        'empleado_id',
        'fecha_fin',
        'estado',
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class);
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
