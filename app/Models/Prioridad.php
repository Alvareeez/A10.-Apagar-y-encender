<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    protected $table = 'prioridad';

    protected $fillable = ['prioridad'];

    /**
     * Relación: Una prioridad puede estar asociada a muchas incidencias.
     */
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class);
    }
}
