<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos de prueba para la tabla 'incidencia'
        $incidencias = [
            // Categoría 1 - Subcategorías de Software
            [
                'titulo' => 'Problema con aplicación de gestión',
                'descripcion' => 'La aplicación de gestión administrativa no responde.',
                'comentario' => 'Revisar configuración del servidor.',
                'imagen' => null,
                'subcategoria' => 1,
                'usuario_creador' => 5, // Cliente Barcelona
                'tecnico_asignado' => null, // Sin técnico asignado
                'estado' => 1,
                'prioridad' => 2,
                'categoria' => 1,
                'seu' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Problema con acceso remoto',
                'descripcion' => 'No se puede acceder remotamente al sistema.',
                'comentario' => 'Verificar credenciales y conexión.',
                'imagen' => null,
                'subcategoria' => 2,
                'usuario_creador' => 6, // Cliente Barcelona
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 1,
                'categoria' => 1,
                'seu' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Categoría 2 - Subcategorías de Hardware
            [
                'titulo' => 'Teclado no funciona',
                'descripcion' => 'El teclado no responde al escribir.',
                'comentario' => 'Revisar conexión y reemplazar si es necesario.',
                'imagen' => null,
                'subcategoria' => 3,
                'usuario_creador' => 7, // Cliente Barcelona
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 3,
                'categoria' => 2,
                'seu' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Monitor no se enciende',
                'descripcion' => 'El monitor no muestra imagen.',
                'comentario' => 'Revisar cableado y fuente de alimentación.',
                'imagen' => null,
                'subcategoria' => 4,
                'usuario_creador' => 8, // Cliente Berlín
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 1,
                'categoria' => 2,
                'seu' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Categoría 3 - Subcategorías de Redes
            [
                'titulo' => 'Conexión inestable',
                'descripcion' => 'La conexión a internet se corta constantemente.',
                'comentario' => 'Revisar configuración del router.',
                'imagen' => null,
                'subcategoria' => 5,
                'usuario_creador' => 9, // Cliente Berlín
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 2,
                'categoria' => 3,
                'seu' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Problemas de velocidad',
                'descripcion' => 'La velocidad de internet es muy baja.',
                'comentario' => 'Verificar el ancho de banda contratado.',
                'imagen' => null,
                'subcategoria' => 6,
                'usuario_creador' => 10, // Cliente Berlín
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 3,
                'categoria' => 3,
                'seu' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Categoría 4 - Subcategorías de Seguridad
            [
                'titulo' => 'Virus detectado',
                'descripcion' => 'Se detectó un virus en el sistema.',
                'comentario' => 'Ejecutar un análisis completo.',
                'imagen' => null,
                'subcategoria' => 7,
                'usuario_creador' => 11, // Cliente Montreal
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 1,
                'categoria' => 4,
                'seu' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Problemas de acceso',
                'descripcion' => 'No se puede acceder a la red interna.',
                'comentario' => 'Revisar permisos y configuración.',
                'imagen' => null,
                'subcategoria' => 8,
                'usuario_creador' => 12, // Cliente Montreal
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 2,
                'categoria' => 4,
                'seu' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Categoría 5 - Subcategorías de Mantenimiento
            [
                'titulo' => 'Limpieza de hardware',
                'descripcion' => 'El equipo necesita una limpieza interna.',
                'comentario' => 'Revisar ventiladores y disipadores.',
                'imagen' => null,
                'subcategoria' => 9,
                'usuario_creador' => 13, // Cliente Montreal
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 2,
                'categoria' => 5,
                'seu' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Actualización de software',
                'descripcion' => 'El software necesita ser actualizado.',
                'comentario' => 'Instalar la última versión disponible.',
                'imagen' => null,
                'subcategoria' => 10,
                'usuario_creador' => 5, // Cliente Barcelona
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 1,
                'categoria' => 5,
                'seu' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Categoría 6 - Subcategorías de Instalación
            [
                'titulo' => 'Instalación de software',
                'descripcion' => 'Se requiere instalar un nuevo software en los equipos.',
                'comentario' => 'Verificar compatibilidad antes de la instalación.',
                'imagen' => null,
                'subcategoria' => 11,
                'usuario_creador' => 6, // Cliente Barcelona
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 2,
                'categoria' => 6,
                'seu' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Configuración de red',
                'descripcion' => 'Se necesita configurar una nueva red en la oficina.',
                'comentario' => 'Asegurarse de que la red sea segura.',
                'imagen' => null,
                'subcategoria' => 12,
                'usuario_creador' => 7, // Cliente Barcelona
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 1,
                'categoria' => 6,
                'seu' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
    
            // Categoría 7 - Subcategorías de Soporte Técnico
            [
                'titulo' => 'Asistencia remota',
                'descripcion' => 'El cliente necesita asistencia remota para resolver un problema.',
                'comentario' => 'Conectar al equipo del cliente y resolver el problema.',
                'imagen' => null,
                'subcategoria' => 13,
                'usuario_creador' => 8, // Cliente Berlín
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 3,
                'categoria' => 7,
                'seu' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Consulta técnica',
                'descripcion' => 'El cliente tiene dudas sobre el funcionamiento de un sistema.',
                'comentario' => 'Proporcionar una explicación detallada.',
                'imagen' => null,
                'subcategoria' => 14,
                'usuario_creador' => 9, // Cliente Berlín
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 1,
                'categoria' => 7,
                'seu' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
    
            // Categoría 8 - Subcategorías de Desarrollo
            [
                'titulo' => 'Desarrollo de software a medida',
                'descripcion' => 'El cliente necesita un software personalizado.',
                'comentario' => 'Reunirse con el cliente para definir los requisitos.',
                'imagen' => null,
                'subcategoria' => 15,
                'usuario_creador' => 10, // Cliente Berlín
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 2,
                'categoria' => 8,
                'seu' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Pruebas de software',
                'descripcion' => 'Se necesita realizar pruebas en un software desarrollado.',
                'comentario' => 'Asegurarse de que no haya errores críticos.',
                'imagen' => null,
                'subcategoria' => 16,
                'usuario_creador' => 11, // Cliente Montreal
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 3,
                'categoria' => 8,
                'seu' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Optimización de base de datos',
                'descripcion' => 'Se necesita optimizar la base de datos para mejorar el rendimiento.',
                'comentario' => 'Revisar índices y consultas lentas.',
                'imagen' => null,
                'subcategoria' => 21,
                'usuario_creador' => 12, // Cliente Montreal
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 2,
                'categoria' => 8,
                'seu' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
    
            // Categoría 9 - Subcategorías de Documentación
            [
                'titulo' => 'Documentación técnica',
                'descripcion' => 'Se necesita crear documentación técnica para un sistema.',
                'comentario' => 'Incluir diagramas y explicaciones detalladas.',
                'imagen' => null,
                'subcategoria' => 17,
                'usuario_creador' => 13, // Cliente Montreal
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 1,
                'categoria' => 9,
                'seu' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Manual de usuario',
                'descripcion' => 'Se necesita crear un manual de usuario para un sistema.',
                'comentario' => 'Incluir capturas de pantalla y pasos detallados.',
                'imagen' => null,
                'subcategoria' => 18,
                'usuario_creador' => 5, // Cliente Barcelona
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 2,
                'categoria' => 9,
                'seu' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Actualización de manuales',
                'descripcion' => 'Se necesita actualizar los manuales de usuario existentes.',
                'comentario' => 'Incluir las nuevas funcionalidades del sistema.',
                'imagen' => null,
                'subcategoria' => 25,
                'usuario_creador' => 6, // Cliente Barcelona
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 1,
                'categoria' => 9,
                'seu' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
    
            // Categoría 10 - Subcategorías de Auditoría
            [
                'titulo' => 'Auditoría de seguridad',
                'descripcion' => 'Se necesita realizar una auditoría de seguridad en el sistema.',
                'comentario' => 'Identificar posibles vulnerabilidades.',
                'imagen' => null,
                'subcategoria' => 19,
                'usuario_creador' => 7, // Cliente Barcelona
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 2,
                'categoria' => 10,
                'seu' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Auditoría de rendimiento',
                'descripcion' => 'Se necesita evaluar el rendimiento del sistema.',
                'comentario' => 'Probar el sistema bajo diferentes cargas.',
                'imagen' => null,
                'subcategoria' => 20,
                'usuario_creador' => 8, // Cliente Berlín
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 1,
                'categoria' => 10,
                'seu' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Auditoría de procesos internos',
                'descripcion' => 'Se necesita realizar una auditoría de los procesos internos.',
                'comentario' => 'Identificar áreas de mejora en los procesos.',
                'imagen' => null,
                'subcategoria' => 23,
                'usuario_creador' => 9, // Cliente Berlín
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 3,
                'categoria' => 10,
                'seu' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
    
            // Categoría 4 - Subcategorías de Seguridad
            [
                'titulo' => 'Revisión de políticas de seguridad',
                'descripcion' => 'Se necesita revisar las políticas de seguridad de la empresa.',
                'comentario' => 'Actualizar las políticas según las normativas actuales.',
                'imagen' => null,
                'subcategoria' => 22,
                'usuario_creador' => 10, // Cliente Berlín
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 1,
                'categoria' => 4,
                'seu' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
    
            // Categoría 7 - Subcategorías de Soporte Técnico
            [
                'titulo' => 'Capacitación técnica',
                'descripcion' => 'Se necesita capacitar al personal técnico en nuevas herramientas.',
                'comentario' => 'Organizar sesiones de capacitación.',
                'imagen' => null,
                'subcategoria' => 24,
                'usuario_creador' => 11, // Cliente Montreal
                'tecnico_asignado' => null,
                'estado' => 1,
                'prioridad' => 2,
                'categoria' => 7,
                'seu' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insertar los datos en la tabla 'incidencia'
        DB::table('incidencia')->insert($incidencias);
    }
}