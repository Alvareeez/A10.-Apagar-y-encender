<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\User;
use App\Models\Rol;
use App\Models\Seu;
use Illuminate\Support\Facades\Auth; // Importar el facade Auth

class GestorController extends Controller
{

    public function dashboard(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) { // Usar el facade Auth
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        // Obtener las incidencias filtradas
        $incidencias = Incidencia::query();

        // Filtrar por prioridad
        if ($request->has('prioridad') && $request->prioridad != '') {
            $incidencias->where('prioridad', $request->prioridad);
        }

        // Filtrar por estado
        if ($request->has('estado') && $request->estado != '') {
            $incidencias->where('estado', $request->estado);
        }

        // Filtrar por sede del usuario
        $incidencias->where('seu', Auth::user()->seu);

        // Ordenar por prioridad y fecha de entrada
        $incidencias->orderBy('prioridad', 'desc')->orderBy('created_at', 'desc');

        // Obtener las incidencias
        $incidencias = $incidencias->get();

        // Obtener el rol "Tecnico" de la tabla "roles"
        $roleTecnico = Rol::where('roles', 'Técnico de Mantenimiento')->first();

        if (!$roleTecnico) {
            return redirect()->route('gestor.dashboard')->with('error', 'El rol "Tecnico" no existe en la base de datos.');
        }

        // Obtener los usuarios con el rol "Tecnico" y que pertenezcan a la misma sede que el gestor actual
        $tecnicos = User::where('role', $roleTecnico->id)
                        ->where('seu', Auth::user()->seu) // Usar el facade Auth
                        ->get();

        return view('gestor.dashboard', compact('incidencias', 'tecnicos'));
    }

    public function tecnicos()
    {
        // Obtener el rol "Tecnico" de la tabla "roles"
        $roleTecnico = Rol::where('roles', 'Técnico de Mantenimiento')->first();

        if (!$roleTecnico) {
            return redirect()->route('gestor.dashboard')->with('error', 'El rol "Tecnico" no existe en la base de datos.');
        }

        // Obtener los usuarios con el rol "Tecnico" y que pertenezcan a la misma sede que el gestor actual
        $tecnicos = User::where('role', $roleTecnico->id)
                        ->where('seu', Auth::user()->seu)
                        ->get();

        return view('gestor.tecnicos', compact('tecnicos'));
    }

    public function incidenciasTecnico($id)
    {
        $tecnico = User::findOrFail($id);

        // Obtener las incidencias asignadas al técnico
        $incidencias = Incidencia::where('tecnico_asignado', $id)->get();

        return view('gestor.incidencias_tecnico', compact('tecnico', 'incidencias'));
    }

    public function detallesIncidencia($id)
    {
        $incidencia = Incidencia::findOrFail($id);

        return view('gestor.detalles_incidencia', compact('incidencia'));
    }

    public function asignarTecnico(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'tecnico_id' => 'required|exists:users,id',
        ]);

        // Asignar el técnico a la incidencia
        $incidencia = Incidencia::findOrFail($id);
        $incidencia->update([
            'estado' => $request->estado_id,
            'tecnico_asignado' => $request->tecnico_id,
        ]);

        return redirect()->route('gestor.dashboard')->with('success', 'Incidencia asignada correctamente.');
    }
}