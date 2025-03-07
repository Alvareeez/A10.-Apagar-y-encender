<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table = 'subcategorias';

    protected $fillable = ['subcategoria', 'categoria'];
    /**
     * Relación: Una subcategoría pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Relación: Una subcategoría puede estar asociada a muchas incidencias.
     */
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class);
    }
}
