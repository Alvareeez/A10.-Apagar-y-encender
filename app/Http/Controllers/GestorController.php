<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\User;
use App\Models\Rol;
use App\Models\Seu;
use Illuminate\Support\Facades\Auth; // Importar el facade Auth
use Illuminate\Support\Facades\Storage;

class GestorController extends Controller
{
    public function dashboard()
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) { // Usar el facade Auth
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        return view('gestor.dashboard');
    }

    public function incidencias(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) { // Usar el facade Auth
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        // Obtener las incidencias filtradas
        $incidencias = Incidencia::where('seu', Auth::user()->seu)
            ->orderBy('prioridad', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Obtener el rol "Tecnico" de la tabla "roles"
        $roleTecnico = Rol::where('roles', 'tècnic manteniment')->first();

        if (!$roleTecnico) {
            return redirect()->route('gestor.dashboard')->with('error', 'El rol "Tecnico" no existe en la base de datos.');
        }

        // Obtener los usuarios con el rol "Tecnico" y que pertenezcan a la misma sede que el gestor actual
        $tecnicos = User::where('role', $roleTecnico->id)
            ->where('seu', Auth::user()->seu) // Usar el facade Auth
            ->get();

        return view('gestor.incidencias', compact('incidencias', 'tecnicos'));
    }

    public function tecnicos()
    {
        // Obtener el rol "Tecnico" de la tabla "roles"
        $roleTecnico = Rol::where('roles', 'tècnic manteniment')->first();

        if (!$roleTecnico) {
            return redirect()->route('gestor.dashboard')->with('error', 'El rol "Tecnico" no existe en la base de datos.');
        }

        // Obtener los usuarios con el rol "Tecnico" y que pertenezcan a la misma sede que el gestor actual
        $tecnicos = User::where('role', $roleTecnico->id)
            ->where('seu', Auth::user()->seu) // Usar el facade Auth
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
            'prioridad' => 'required|string|in:alta,media,baja',
        ]);

        // Asignar el técnico y la prioridad a la incidencia
        $incidencia = Incidencia::findOrFail($id);
        $incidencia->tecnico_asignado = $request->tecnico_id;
        $incidencia->prioridad = $request->prioridad;
        $incidencia->estado = 'asignada'; // Establecer el estado a 'asignada' o el valor correspondiente
        $incidencia->save();

        return redirect()->route('gestor.incidencias')->with('success', 'Incidencia asignada correctamente.');
    }

    public function perfil()
    {
        return view('gestor.perfil');
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

        return redirect()->route('gestor.perfil')->with('success', 'Foto de perfil actualizada correctamente.');
    }
}