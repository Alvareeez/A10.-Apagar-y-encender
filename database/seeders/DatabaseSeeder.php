<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolSeeder::class,
            SeuSeeder::class,
            EstadoSeeder::class,
            PrioridadSeeder::class,
            CategoriaSeeder::class,
            SubcategoriaSeeder::class,
            UserSeeder::class,
            IncidenciaSeeder::class,
        ]);
    }
}