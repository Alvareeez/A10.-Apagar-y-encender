<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        // Buscar el ID del estado "En trabajo"
    $estadoEnTrabajo = \App\Models\Estado::where('estado', 'En trabajo')->first();

    if (!$estadoEnTrabajo) {
        return redirect()->back()->with('error', 'El estado "En trabajo" no existe.');
    }

    // Actualizar la incidencia
    $incidencia = \App\Models\Incidencia::findOrFail($id);
    $incidencia->estado = $estadoEnTrabajo->id; // Guardar el ID del estado
    $incidencia->save();
    return redirect()->route('tecnico.dashboard')->with('success', 'Incidencia marcada como resuelta.');

    }

    /**
     * Cambiar el estado de una incidencia a "Resolta".
     */
    public function resolve($id)
    {
        // Buscar el ID del estado "Resuelta"
        $estadoResuelta = \App\Models\Estado::where('estado', 'Resuelta')->first();
    
        if (!$estadoResuelta) {
            return redirect()->back()->with('error', 'El estado "Resuelta" no existe.');
        }
    
        // Actualizar la incidencia
        $incidencia = \App\Models\Incidencia::findOrFail($id);
        $incidencia->estado = $estadoResuelta->id; // Guardar el ID del estado
        $incidencia->save();

        
    
        return redirect()->route('tecnico.dashboard')->with('success', 'Incidencia marcada como resuelta.');
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
    public function perfil()
    {
        return view('tecnico.perfil');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            // Eliminar la foto de perfil anterior si existe
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }

            // Almacenar la nueva foto de perfil
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        return redirect()->route('tecnico.perfil')->with('success', 'Foto de perfil actualizada correctamente.');
    }
}
