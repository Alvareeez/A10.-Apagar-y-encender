<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function incidenciasCreadas()
    {
        return $this->hasMany(Incidencia::class, 'usuario_creador');
    }

    public function incidenciasAsignadas()
    {
        return $this->hasMany(Incidencia::class, 'tecnico_asignado');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function chatsTecnico()
    {
        return $this->hasMany(Chat::class, 'tecnico_id');
    }

    /**
     * Relación: Un usuario pertenece a un rol.
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    /**
     * Relación: Un usuario pertenece a una sede.
     */
    public function seu()
    {
        return $this->belongsTo(Seu::class);
    }
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class);
    }
}
