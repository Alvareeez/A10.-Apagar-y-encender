<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prioridad;

class PrioridadSeeder extends Seeder
{
    public function run()
    {
        $prioridades = [
            ['prioridad' => 'Alta'],
            ['prioridad' => 'Media'],
            ['prioridad' => 'Baja'],
            ['prioridad' => 'Sin prioridad'],
        ];

        foreach ($prioridades as $prioridad) {
            Prioridad::create($prioridad);
        }
    }
}