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
        return $this->belongsTo(User::class, 'tecnico_asignado', 'id');
    }

    /**
     * Relación: Una incidencia tiene un estado.
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado', 'id');
    }

    /**
     * Relación: Una incidencia tiene una prioridad.
     */
    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'prioridad', 'id');
    }

    /**
     * Relación: Una incidencia pertenece a una subcategoría (Ej: "Teclado no funciona").
     */
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'subcategoria', 'id');
    }
    
    /**
     * Relación: Una incidencia pertenece a un creador (usuario que la creó).
     */
    public function creador()
    {
        return $this->belongsTo(User::class, 'usuario_creador', 'id');
    }

    /**
     * Relación: Una incidencia pertenece a una sede.
     */
    public function seu()
    {
        return $this->belongsTo(Seu::class, 'seu');
    }

    /**
     * Relación: Una incidencia pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria', 'id');
    }

    /**
     * Relación: Una incidencia tiene muchos chats.
     */
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function getPrioridadNombreAttribute()
    {
        switch ($this->prioridad) {
            case 1:
                return 'Alta';
            case 2:
                return 'Media';
            case 3:
                return 'Baja';
            default:
                return 'Desconocida';
        }
    }

    public function getEstadoNombreAttribute()
    {
        switch ($this->estado) {
            case 1:
                return 'Sin asignar';
            case 2:
                return 'Asignada';
            case 3:
                return 'En trabajo';
            case 4:
                return 'Resuelta';
            case 5:
                return 'Cerrada';
            default:
                return 'Desconocido';
        }
    }
}

