<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    public function run()
    {
        $estados = [
            ['estado' => 'Sin asignar'],
            ['estado' => 'Asignada'],
            ['estado' => 'En trabajo'],
            ['estado' => 'Resuelta'],
            ['estado' => 'Cerrada'],
        ];

        foreach ($estados as $estado) {
            Estado::create($estado);
        }
    }
}