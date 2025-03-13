<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IncidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos de prueba para la tabla 'incidencia'
        $incidencias = [
            [
                'titulo' => 'Problema con impresora',
                'descripcion' => 'La impresora no imprime correctamente.',
                'subcategoria' => 'Hardware',
                'comentario' => 'Se necesita revisión técnica urgente.',
                'imagen' => null,
                'usuario_creador' => 1, // ID de un usuario existente en la tabla 'users'
                'tecnico_asignado' => 2, // ID de un usuario existente en la tabla 'users'
                'estado' => 1, // ID de un estado existente en la tabla 'estado'
                'prioridad' => 2, // ID de una prioridad existente en la tabla 'prioridad'
                'categoria' => 3, // ID de una categoría existente en la tabla 'categorias'
                'seu' => 1, // ID de una sede existente en la tabla 'seus'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Fallo en el sistema',
                'descripcion' => 'El sistema se bloquea al iniciar sesión.',
                'subcategoria' => 'Software',
                'comentario' => 'Posible conflicto con la versión actual.',
                'imagen' => 'imagenes/fallo_sistema.jpg',
                'usuario_creador' => 2,
                'tecnico_asignado' => 9, // Sin técnico asignado
                'estado' => 3,
                'prioridad' => 1,
                'categoria' => 2,
                'seu' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Pérdida de conexión',
                'descripcion' => 'No hay conexión a internet en la oficina principal.',
                'subcategoria' => 'Red',
                'comentario' => 'Verificar configuración del router.',
                'imagen' => null,
                'usuario_creador' => 3,
                'tecnico_asignado' => 9,
                'estado' => 2,
                'prioridad' => 3,
                'categoria' => 1,
                'seu' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insertar los datos en la tabla 'incidencia'
        DB::table('incidencia')->insert($incidencias);
    }
}