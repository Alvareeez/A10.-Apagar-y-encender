<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['roles' => 'Administrador'],
            ['roles' => 'Cliente'],
            ['roles' => 'Gestor de Equipo'],
            ['roles' => 'Técnico de Mantenimiento'],
        ];

        foreach ($roles as $rol) {
            Rol::create($rol);
        }
    }
}