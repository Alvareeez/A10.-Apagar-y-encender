<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'incidencia_id',
        'user_id',
        'tecnico_id',
        'message',
    ];

    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class);
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }
}
