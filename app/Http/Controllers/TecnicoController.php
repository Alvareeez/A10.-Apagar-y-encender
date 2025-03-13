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

    public function filter(Request $request)
    {
        $search = $request->input('search'); // Valor del campo de búsqueda
        $filter = $request->input('filter'); // Valor del filtro de estado
    
        // Consulta base
        $query = Incidencia::query();
    
        // Aplicar filtro de búsqueda
        if (!empty($search)) {
            $query->where('titulo', 'LIKE', '%' . $search . '%');
        }
    
        // Excluir incidencias con estado "Sin asignar"
        $query->whereHas('Estado', function ($q) {
            $q->where('estado', '!=', 'Sin asignar'); // Excluir "Sin asignar"
        });
    
        // Aplicar filtro de estado
        if ($filter !== 'Todas') {
            $query->whereHas('Estado', function ($q) use ($filter) {
                $q->where('estado', $filter);
            });
        }
    
        // Obtener resultados
        $incidencies = $query->get();
    
        // Retornar vista con los resultados filtrados
        return view('tecnico.incidencias-list', compact('incidencies'));
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
