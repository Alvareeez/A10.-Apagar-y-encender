<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $table = 'subcategorias';

    protected $fillable = ['subcategoria', 'categoria'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria');
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'subcategoria');
    }
}
