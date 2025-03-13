<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Incidencia;
use App\Models\User;
use App\Models\Estado;
use App\Models\Prioridad;
use App\Models\Categoria;

class IncidenciaSeeder extends Seeder
{
    public function run()
    {
        // Obtener IDs válidos
        $cliente = User::where('email', 'cliente.barcelona@example.com')->first()->id;
        $tecnico = User::where('email', 'tecnico.barcelona@example.com')->first()->id;
        $estadoSinAsignar = Estado::where('estado', 'Sin asignar')->first()->id;
        $estadoAsignada = Estado::where('estado', 'Asignada')->first()->id;
        $prioridadAlta = Prioridad::where('prioridad', 'Alta')->first()->id;
        $categoriaHardware = Categoria::where('categoria', 'Hardware')->first()->id; // Asegúrate de que esta categoría exista

        $incidencias = [
            [
                'titulo' => 'Teclado no responde',
                'descripcion' => 'El teclado no responde correctamente.',
                'cliente_id' => $cliente,
                'tecnico_asignado' => null, // Sin técnico asignado inicialmente
                'estado' => $estadoSinAsignar,
                'prioridad' => $prioridadAlta,
                'categoria' => $categoriaHardware, // Usar el ID válido de la categoría
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Monitor no se enciende',
                'descripcion' => 'El monitor no muestra señal.',
                'cliente_id' => $cliente,
                'tecnico_asignado' => $tecnico,
                'estado' => $estadoAsignada,
                'prioridad' => $prioridadAlta,
                'categoria' => $categoriaHardware, // Usar el ID válido de la categoría
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($incidencias as $incidencia) {
            Incidencia::create($incidencia);
        }
    }
}