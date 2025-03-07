<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seu extends Model
{
    protected $table = 'seus';
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class, 'seu_id'); // Relación con el modelo User
    }
}
