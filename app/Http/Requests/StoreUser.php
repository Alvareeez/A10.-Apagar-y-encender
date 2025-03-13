<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3'],
            'apellido' => ['required', 'min:5'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required','min:8', 'confirmed'],
            'rol_id' => ['required']
        ];
    }

    public function attributes() : array{
        return[
            'name' => 'Nombre de usuario',
            'apellido' => 'Apellido de usuario',
            'email' => 'Correo electrónico',
            'password' => 'Contraseña'
        ];
    }
}
