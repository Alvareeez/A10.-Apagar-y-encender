<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\User;
use App\Models\Rol;
use App\Models\Seu;
use App\Models\Estado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GestorController extends Controller
{
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        return view('gestor.dashboard');
    }

    public function incidencias()
    {
        $incidencias = Incidencia::where('seu', Auth::user()->seu)
            ->orderBy('prioridad', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $roleTecnico = Rol::where('roles', 'Técnico de Mantenimiento')->first();

        if (!$roleTecnico) {
            return redirect()->route('gestor.dashboard')->with('error', 'El rol "Técnico" no existe en la base de datos.');
        }

        $tecnicos = User::where('role', $roleTecnico->id)
            ->where('seu', Auth::user()->seu)
            ->get();

        $estados = Estado::all();

        return view('gestor.incidencias', compact('incidencias', 'tecnicos', 'estados'));
    }

    public function tecnicos()
    {
        $roleTecnico = Rol::where('roles', 'Técnico de Mantenimiento')->first();

        if (!$roleTecnico) {
            return redirect()->route('gestor.dashboard')->with('error', 'El rol "Técnico" no existe en la base de datos.');
        }

        $tecnicos = User::where('role', $roleTecnico->id)
            ->where('seu', Auth::user()->seu)
            ->get();

        return view('gestor.tecnicos', compact('tecnicos'));
    }

    public function incidenciasTecnico($id)
    {
        $tecnico = User::findOrFail($id);

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
        $request->validate([
            'tecnico_id' => 'required|exists:users,id',
            'prioridad' => 'required|string|in:alta,media,baja',
        ]);

        $incidencia = Incidencia::findOrFail($id);
        $incidencia->tecnico_asignado = $request->tecnico_id;
        $incidencia->prioridad = $this->convertirPrioridad($request->prioridad);
        $incidencia->estado = 2; // Cambiar el estado a 'Asignada'
        $incidencia->save();

        return redirect()->route('gestor.incidencias')->with('success', 'Incidencia asignada correctamente.');
    }

    private function convertirPrioridad($prioridad)
    {
        switch ($prioridad) {
            case 'alta':
                return 1;
            case 'media':
                return 2;
            case 'baja':
                return 3;
            default:
                return 2; // Valor por defecto
        }
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
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }

            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        return redirect()->route('gestor.perfil')->with('success', 'Foto de perfil actualizada correctamente.');
    }
}
