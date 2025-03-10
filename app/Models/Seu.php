<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seu extends Model
{
    protected $table = 'seus';
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class, 'seu'); // Relación con User, usando 'seu' como clave foránea
    }
}