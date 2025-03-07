<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{

    protected $table = 'incidencia';

    protected $fillable = [
        'titulo',
        'descripcion',
        'cliente_id', // Usuario que creó la incidencia
        'tecnico_id', // Usuario asignado (nullable hasta que se asigne)
        'estado_id',
        'prioridad_id',
        'subcategoria_id',
        'fecha_creacion',
        'fecha_resolucion',
    ];

    /**
     * Relación: Una incidencia pertenece a un cliente (usuario que la reportó).
     */
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    /**
     * Relación: Una incidencia pertenece a un técnico (usuario que la resolverá).
     */
    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id')->nullable();
    }

    /**
     * Relación: Una incidencia tiene un estado (Sin asignar, Asignada, En trabajo, Resuelta, Cerrada).
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    /**
     * Relación: Una incidencia tiene una prioridad (Alta, Media, Baja).
     */
    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class);
    }

    /**
     * Relación: Una incidencia pertenece a una subcategoría (Ej: "Teclado no funciona").
     */
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }
}
