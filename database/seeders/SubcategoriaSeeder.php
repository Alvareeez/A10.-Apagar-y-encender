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
            ['subcategoria' => 'Problemas de velocidad', 'categoria' => 3],
            // Seguridad
            ['subcategoria' => 'Virus o malware', 'categoria' => 4],
            ['subcategoria' => 'Problemas de acceso a la red', 'categoria' => 4],
            ['subcategoria' => 'Actualización de antivirus', 'categoria' => 4],
            // Mantenimiento
            ['subcategoria' => 'Limpieza de hardware', 'categoria' => 5],
            ['subcategoria' => 'Actualización de software', 'categoria' => 5],
            ['subcategoria' => 'Revisión de seguridad', 'categoria' => 5],
            // Instalación
            ['subcategoria' => 'Instalación de software', 'categoria' => 6],
            ['subcategoria' => 'Instalación de hardware', 'categoria' => 6],
            ['subcategoria' => 'Configuración de red', 'categoria' => 6],
            // Soporte Técnico
            ['subcategoria' => 'Asistencia remota', 'categoria' => 7],
            ['subcategoria' => 'Asistencia presencial', 'categoria' => 7],
            ['subcategoria' => 'Consulta técnica', 'categoria' => 7],
            // Desarrollo
            ['subcategoria' => 'Desarrollo de software a medida', 'categoria' => 8],
            ['subcategoria' => 'Mantenimiento de software', 'categoria' => 8],
            ['subcategoria' => 'Pruebas de software', 'categoria' => 8],
            // Documentación
            ['subcategoria' => 'Documentación técnica', 'categoria' => 9],
            ['subcategoria' => 'Manual de usuario', 'categoria' => 9],
            ['subcategoria' => 'Guía de instalación', 'categoria' => 9],
            // Auditoría
            ['subcategoria' => 'Auditoría de seguridad', 'categoria' => 10],
            ['subcategoria' => 'Auditoría de rendimiento', 'categoria' => 10],
            ['subcategoria' => 'Auditoría de cumplimiento normativo', 'categoria' => 10],
        ];

        foreach ($subcategorias as $subcategoria) {
            Subcategoria::create($subcategoria);
        }
    }
}