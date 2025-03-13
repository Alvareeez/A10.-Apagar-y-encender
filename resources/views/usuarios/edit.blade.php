@extends('layouts.layout')

@section('title', 'Editar Usuario')

@section('menu-navbar')
    <div class="d-flex ms-auto">
        <th><a href="{{ route('usuarios.index') }}" class="btn btn-success"><i class="fa-solid fa-backward"></i></a></th>
    </div>
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('styles/editUser.css') }}">
    <div class="container-fuera">
        <div class="container-dentro">
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="name">Nombre de usuario</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $usuario->name) }}">

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" class="form-control" value="{{ old('apellido', $usuario->apellido) }}">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}">

                <label for="rol_id">Rol</label>
                <select id="rol_id" name="rol_id" class="form-control">
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}" 
                            {{ old('rol_id', $usuario->rol_id) == $rol->id ? 'selected' : '' }}>
                            {{ $rol->nombreRol }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary mt-3">Actualizar Usuario</button>
            </form>
        </div>
    </div>
@endsection
