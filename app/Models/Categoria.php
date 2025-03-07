<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = ['categoria'];

    /**
     * Relación: Una categoría tiene muchas subcategorías.
     */
    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class);
    }
}
