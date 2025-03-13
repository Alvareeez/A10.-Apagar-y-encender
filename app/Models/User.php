<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'role',
        'seu',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
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
        return $this->belongsTo(Rol::class, 'role');
    }

    /**
     * Relación: Un usuario pertenece a una sede.
     */
    public function seu()
    {
        return $this->belongsTo(Seu::class, 'seu');
    }
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class);
    }
}
