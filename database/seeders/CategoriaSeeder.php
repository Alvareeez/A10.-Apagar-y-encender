<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            ['categoria' => 'Software'],
            ['categoria' => 'Hardware'],
            ['categoria' => 'Redes'],
            ['categoria' => 'Seguridad'],
            ['categoria' => 'Mantenimiento'],
            ['categoria' => 'Instalación'],
            ['categoria' => 'Soporte Técnico'],
            ['categoria' => 'Desarrollo'],
            ['categoria' => 'Documentación'],
            ['categoria' => 'Auditoría'],   
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}