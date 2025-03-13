@extends('layouts.layout')

@section('title', 'Añadir Usuario')

@section('menu-navbar')
    <div class="d-flex ms-auto">
        <th><a href="{{ route('usuarios.index') }}" class="btn btn-success">
            <i class="fa-solid fa-backward"></i>
        </a></th>
    </div>
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('styles/addUser.css') }}">
    <div class="container-fuera">
        <div class="container-dentro">
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <label for="name">Nombre:</label><br>
                <input type="text" id="name" name="name" value="{{ old('name') }}"><br><br>
                <span id="error_name" class="error-message"></span>

                <label for="apellido">Apellido:</label><br>
                <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}"><br><br>
                <span id="error_apellido" class="error-message"></span>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" value="{{ old('email') }}"><br><br>
                <span id="error_email" class="error-message"></span>

                <label for="password">Contraseña:</label><br>
                <input type="password" id="password" name="password"><br><br>
                <span id="error_password" class="error-message"></span>

                <label for="password_confirmation">Confirmar Contraseña:</label><br>
                <input type="password" id="password_confirmation" name="password_confirmation"><br><br>
                <span id="error_password_confirmation" class="error-message"></span>

                <label for="rol_id">Rol:</label><br>
                <select id="rol_id" name="rol_id">
                    <option value="">Seleccionar un rol</option>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                            {{ $rol->nombreRol }}
                        </option>
                    @endforeach
                </select><br><br>
                <span id="error_rol" class="error-message"></span>

                <button type="submit">Añadir</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/validaCreate.js') }}"></script>
@endsection
