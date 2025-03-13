<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use Illuminate\Support\Facades\Auth;

class TecnicoController extends Controller
{
    /**
     * Mostrar el dashboard del técnico.
     */
    public function dashboard()
    {
        // Obtener las incidencias asignadas al técnico actual, cargando las relaciones 'estado' y 'prioridad'
        $incidencies = Incidencia::where('tecnico_asignado', Auth::id())
            ->with(['estado', 'prioridad']) // Cargar las relaciones
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tecnico.dashboard', compact('incidencies'));
    }

    /**
     * Filtrar incidencias por estado.
     */
    public function filter(Request $request)
    {
        $filter = $request->input('filter');

        // Obtener las incidencias según el filtro
        $query = Incidencia::where('tecnico_asignado', Auth::id());

        if ($filter !== 'all') {
            $query->where('estado', $filter);
        }

        $incidencies = $query->with(['estado', 'prioridad'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tecnico.dashboard', compact('incidencies'));
    }

    /**
     * Cambiar el estado de una incidencia a "En treball".
     */
    public function startWork($id)
    {
        $incidencia = Incidencia::findOrFail($id);

        if ($incidencia->tecnico_asignado !== Auth::id()) {
            return back()->with('error', 'No tienes permiso para modificar esta incidencia.');
        }

        $incidencia->update(['estado' => 'En trabajo']);
        return redirect()->route('tecnico.dashboard')->with('success', 'Incidència marcada com "En treball".');
    }

    /**
     * Cambiar el estado de una incidencia a "Resolta".
     */
    public function resolve($id)
    {
        $incidencia = Incidencia::findOrFail($id);

        if ($incidencia->tecnico_asignado !== Auth::id()) {
            return back()->with('error', 'No tienes permiso para modificar esta incidencia.');
        }

        $incidencia->update(['estado' => 'Resuelta']);
        return redirect()->route('tecnico.dashboard')->with('success', 'Incidencia marcada como "Resuelta".');
    }

    /**
     * Mostrar detalles de una incidencia.
     */
    public function show($id)
    {
        $incidencia = Incidencia::with('estado')
            ->findOrFail($id);

        if ($incidencia->tecnico_asignado !== Auth::id()) {
            return back()->with('error', 'No tienes permiso para modificar esta incidencia.');
        }

        return view('tecnico.show', compact('incidencia'));
    }
}
