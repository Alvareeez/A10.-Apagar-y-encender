<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcategoria;

class SubcategoriaSeeder extends Seeder
{
    public function run()
    {
        $subcategorias = [
            // Software
            ['subcategoria' => 'Aplicación de gestión administrativa', 'categoria' => 1],
            ['subcategoria' => 'Acceso remoto', 'categoria' => 1],
            ['subcategoria' => 'Aplicación de videoconferencia', 'categoria' => 1],

            // Hardware
            ['subcategoria' => 'Problema con el teclado', 'categoria' => 2],
            ['subcategoria' => 'Ratón no funciona', 'categoria' => 2],
            ['subcategoria' => 'Monitor no se enciende', 'categoria' => 2],

            // Redes
            ['subcategoria' => 'Conexión inestable', 'categoria' => 3],
            ['subcategoria' => 'Fallo en el router', 'categoria' => 3],
        ];

        foreach ($subcategorias as $subcategoria) {
            Subcategoria::create($subcategoria);
        }
    }
}