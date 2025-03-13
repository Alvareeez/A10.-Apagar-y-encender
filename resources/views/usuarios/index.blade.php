@extends('layouts.layout')

@section('title', 'Gestión de Usuarios')

@section('menu-navbar')
    <div class="d-flex ms-auto">
        <th><a href="{{route('usuarios.create')}}" class="btn btn-success">Añadir Usuario</a></th>
    </div>

@endsection


@section('content')
<div class="d-flex ms-auto">
    <a href="{{route('admin')}}" class="btn btn-volverAtras">Volver</a>
</div>
    <link rel="stylesheet" href="{{ asset('styles/crudUsers.css') }}">
    <h1>Gestionar usuario</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>

            </tr>

        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->apellido }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->rol->nombreRol }}</td>
                    <td>

                        <a href="{{route('usuarios.edit' , $usuario->id)}}"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('usuarios.destroy', $usuario) }}"  method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach 
        </tbody>
    </table>
@endsection