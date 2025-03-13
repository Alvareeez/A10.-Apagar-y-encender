<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUser;

class UserController extends Controller
{
    public function index()
    {
        $usuarios =  User::with('rol')->paginate(15);
        return view('usuarios.index', compact('usuarios'));
    }

    /* METODOS INSERT*/
    public function create()
    {
        $roles =  Rol::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(StoreUser $request)
    {
        //Iniciar transaccion 
        DB::beginTransaction();
        try {
            // Creación del usuario
            $usuario = new User();
            $usuario->name = $request->name;
            $usuario->apellido = $request->apellido;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->role = $request->role; // Asignar el ID del rol
            $usuario->save();

            DB::commit();
            return redirect()->route('usuarios.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('usuarios.create')->with('Ha habido un error al crear el usuario');
        }
    }


    // /* METODOS UPDATE */
    public function edit(User $usuario)
    {
        $roles = Rol::all(); // Obtener todos los roles disponibles
        return view('usuarios.edit', compact('usuario', 'roles'));
    }


    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $usuario->id,
            'role' => 'required|exists:roles,id' // Asegura que el rol seleccionado exista
        ]);

        // Actualizar datos del usuario
        $usuario->name = $request->name;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
        $usuario->role = $request->role; // Actualizar el ID del rol

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }



    /* METODOS DELETE */
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
