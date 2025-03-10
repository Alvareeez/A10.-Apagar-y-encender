<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $table = 'incidencia';

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'cliente_id',
        'tecnico_asignado',
        'estado',
        'prioridad',
        'categoria',
        'created_at',
        'updated_at',
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
        return $this->belongsTo(User::class, 'tecnico_asignado')->nullable();
    }

    /**
     * Relación: Una incidencia tiene un estado.
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado');
    }

    /**
     * Relación: Una incidencia tiene una prioridad.
     */
    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'prioridad');
    }

    /**
     * Relación: Una incidencia pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria');
    }
}