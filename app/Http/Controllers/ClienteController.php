<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ClienteController extends Controller
{
    public function dashboard(){
        return view('cliente.dashboard');
    }

    public function showProfile()
    {
        return view('cliente.perfil');
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
            $path = $request->file('profile_photo')->store('img', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        return redirect()->route('perfil.show')->with('success', 'Foto de perfil actualizada correctamente.');
    }
}
