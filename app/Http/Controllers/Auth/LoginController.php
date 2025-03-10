<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesar el login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'El correo electrónico no es válido.',
            'password.required' => 'La contraseña es requerida.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirigir según el rol del usuario
            $user = Auth::user();
            switch ($user->role) { // Asegúrate de que el campo sea 'role' en la tabla users
                case 1:
                    return redirect()->route('admin.dashboard');
                case 2:
                    return redirect()->route('cliente.dashboard');
                case 3:
                    return redirect()->route('gestor.dashboard');
                case 4:
                    return redirect()->route('tecnico.dashboard');
                default:
                    return redirect()->route('home'); // Redirige a una página por defecto si el rol no coincide
            }
        }

        // Si las credenciales no coinciden, devolver errores específicos y un mensaje general
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            'password' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->with('error', 'Credenciales incorrectas. Por favor, inténtalo de nuevo.');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}