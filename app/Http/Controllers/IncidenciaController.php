<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Incidencia;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Prioridad;
use App\Models\Estado;
use App\Models\User;
use App\Models\Chat;

class IncidenciaController extends Controller
{
    public function create()
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('cliente.crearincidencias', compact('categorias', 'subcategorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'subcategoria' => 'required|integer',
            'comentario' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoria' => 'required|integer',
        ]);

        $incidencia = new Incidencia();
        $incidencia->titulo = $request->titulo;
        $incidencia->descripcion = $request->descripcion;
        $incidencia->subcategoria = $request->subcategoria;
        $incidencia->comentario = $request->comentario;
        $incidencia->usuario_creador = Auth::id(); // Asociar el usuario autenticado como creador
        $incidencia->tecnico_asignado = null; // No asignar técnico por defecto
        $incidencia->estado = 1; // Estado por defecto "Sin asignar"
        $incidencia->prioridad = 4; // Prioridad por defecto "Sin prioridad"
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
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $tecnicos = User::where('role', 4)->where('seu', Auth::user()->seu)->get();
        $estados = Estado::all();
        $prioridades = Prioridad::all();
        $incidencias = Incidencia::with(['Subcategoria', 'creador', 'tecnico', 'Estado', 'Prioridad', 'Categoria'])
                                 ->where('usuario_creador', Auth::id())
                                 ->get();

        return view('cliente.misincidencias', compact('categorias', 'subcategorias', 'tecnicos', 'estados', 'prioridades', 'incidencias'));
    }

    public function chat($id)
    {
        $incidencia = Incidencia::findOrFail($id);
        $tecnico = User::find($incidencia->tecnico_asignado);
        $chats = Chat::where('incidencia_id', $id)->get();
        return view('cliente.chat', compact('incidencia', 'tecnico', 'chats'));
    }

    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $incidencia = Incidencia::findOrFail($id);

        $chat = new Chat();
        $chat->incidencia_id = $id;
        $chat->user_id = Auth::id();
        $chat->tecnico_id = $incidencia->tecnico_asignado;
        $chat->message = $request->message;
        $chat->save();

        return redirect()->route('incidencias.chat', $id);
    }

    public function filter(Request $request)
    {
        $query = Incidencia::query();

        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('subcategoria')) {
            $query->where('subcategoria', $request->subcategoria);
        }

        if ($request->filled('tecnico')) {
            $query->where('tecnico_asignado', $request->tecnico);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('prioridad')) {
            $query->where('prioridad', $request->prioridad);
        }

        $incidencias = $query->with(['Subcategoria', 'creador', 'tecnico', 'Estado', 'Prioridad', 'Categoria'])
                             ->where('usuario_creador', Auth::id())
                             ->get();

        return view('cliente.incidencias_list', compact('incidencias'))->render();
    }
}