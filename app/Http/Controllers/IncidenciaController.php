<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Seu;
use App\Models\Incidencia;
use App\Models\Categoria;
use App\Models\Subcategoria;

class IncidenciaController extends Controller
{
    public function create()
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $seus = Seu::all();
        return view('cliente.crearincidencias', compact('categorias', 'subcategorias', 'seus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'subcategoria' => 'required|integer',
            'comentario' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'estado' => 'required|integer',
            'prioridad' => 'required|integer',
            'categoria' => 'required|integer',
            'seu' => 'required|integer', // Campo para almacenar la SEU del usuario autenticado
        ]);

        $incidencia = new Incidencia();
        $incidencia->titulo = $request->titulo;
        $incidencia->descripcion = $request->descripcion;
        $incidencia->subcategoria = $request->subcategoria;
        $incidencia->comentario = $request->comentario;
        $incidencia->usuario_creador = Auth::id(); // Asociar el usuario autenticado como creador
        $incidencia->tecnico_asignado = null; // No asignar técnico por defecto
        $incidencia->estado = $request->estado;
        $incidencia->prioridad = $request->prioridad;
        $incidencia->categoria = $request->categoria;
        $incidencia->seu = Auth::user()->seu; // Asociar la sede del usuario autenticado

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->storeAs('img', $request->file('imagen')->getClientOriginalName(), 'public');
            $incidencia->imagen = $path;
        }

        $incidencia->save();

        return redirect()->route('incidencias.create')->with('success', 'Incidencia creada correctamente.');
    }

    public function index()
    {
        $incidencias = Incidencia::where('usuario_creador', Auth::id())->get();
        return view('cliente.misincidencias', compact('incidencias'));
    }
}