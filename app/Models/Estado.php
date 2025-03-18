<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';

    protected $fillable = ['estado'];

    /**
     * Relación: Un estado puede estar asociado a muchas incidencias.
     */
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'estado');
    }
}