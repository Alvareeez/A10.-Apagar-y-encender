<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use App\Models\Seu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUser;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::with('rol', 'seu')->paginate(15);
        return view('admin', compact('usuarios'));
    }

    /* METODOS INSERT*/
    public function create()
    {
        $roles = Rol::all();
        $seus = Seu::all(); // Obtener todas las sedes disponibles
        return view('usuarios.create', compact('roles', 'seus'));
    }

    public function store(StoreUser $request)
    {
        // Iniciar transacción 
        DB::beginTransaction();
        try {
            // Creación del usuario
            $usuario = new User();
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->role = $request->role; // Asignar el ID del rol
            $usuario->seu = $request->seu; // Asignar el ID de la sede
            $usuario->save();

            DB::commit();
            return redirect()->route('usuarios.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('usuarios.create')->with('error', 'Ha habido un error al crear el usuario');
        }
    }

    // METODOS UPDATE
    public function edit(User $usuario)
    {
        $roles = Rol::all(); // Obtener todos los roles disponibles
        $seus = Seu::all(); // Obtener todas las sedes disponibles
        return view('usuarios.edit', compact('usuario', 'roles', 'seus'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $usuario->id,
            'role' => 'required|exists:roles,id', // Asegura que el rol seleccionado exista
            'seu' => 'required|exists:seus,id' // Asegura que la sede seleccionada exista
        ]);

        // Actualizar datos del usuario
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->role = $request->role; // Actualizar el ID del rol
        $usuario->seu = $request->seu; // Actualizar el ID de la sede

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    // METODOS DELETE
    public function destroy(User $usuario)
    {
        try {
            // Ahora elimina el usuario
            $usuario->delete();

            DB::commit(); // Confirma la transacción

            return redirect()->route('usuarios.index');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo eliminar el usuario: ' . $e->getMessage());
        }
    }
}
