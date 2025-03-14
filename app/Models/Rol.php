<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{

    protected $table = 'roles';
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class, 'role');
    }
}
