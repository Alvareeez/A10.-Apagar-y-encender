<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $table = 'incidencia';

    protected $fillable = [
        'titulo',
        'descripcion',
        'subcategoria',
        'comentario',
        'imagen',
        'usuario_creador',
        'tecnico_asignado',
        'estado',
        'prioridad',
        'categoria',
        'seu',
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
        return $this->belongsTo(User::class, 'tecnico_asignado');
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
     * Relación: Una incidencia pertenece a una subcategoría (Ej: "Teclado no funciona").
     */
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }
    
    /**
     * Relación: Una incidencia pertenece a un creador (usuario que la creó).
     */
    public function creador()
    {
        return $this->belongsTo(User::class, 'usuario_creador');
    }

    public function seu()
    {
        return $this->belongsTo(Seu::class, 'seu');
    }
    /**
     * Relación: Una incidencia tiene muchos chats.
     */
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}

