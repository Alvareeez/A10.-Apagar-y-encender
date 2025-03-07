<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';

    protected $fillable = ['estado']; // Campos permitidos para asignación masiva

    /**
     * Relación: Un estado puede estar asociado a muchas incidencias.
     */
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class);
    }
}
