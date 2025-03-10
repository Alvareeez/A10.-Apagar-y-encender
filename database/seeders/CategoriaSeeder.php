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
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}