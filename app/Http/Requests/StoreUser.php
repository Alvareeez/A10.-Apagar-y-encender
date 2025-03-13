<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'seu' => ['required', 'exists:seus,id'],
            'password' => ['required', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,id']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nombre de usuario',
            'email' => 'Correo electrónico',
            'password' => 'Contraseña',
            'seu' => 'Sede',
            'role' => 'Rol'
        ];
    }
}
