<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <img src="" alt="Foto admin">
                <h3 class="my-3">Administrador</h3>
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary w-100 h-50">Crear Usuarios</a>
                <a class="btn btn-primary w-100 h-50">Ver Usuarios</a>
                <a class="btn btn-primary w-100 h-50">Incidéncias</a>
                <button class="btn btn-danger">Cerrar Sesión</button>
            </div>
            <div class="col-7">
                <h1>Gestionar usuario</h1>
                <div class="mb-3">
                    <input type="text" id="search" class="form-control" placeholder="Buscar por nombre o email">
                </div>
                <div class="mb-3">
                    <select id="seu" class="form-control">
                        <option value="">Seleccionar Sede</option>
                        @foreach ($seus as $seu)
                            <option value="{{ $seu->id }}" {{ old('seu') == $seu->id ? 'selected' : '' }}>
                                {{ $seu->seus }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <select id="role" class="form-control">
                        <option value="">Seleccionar Rol</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->roles }}</option>
                        @endforeach
                    </select>
                </div>
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Sede</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="usuarios-table">
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->Seu->seus }}</td>
                                <td>{{ $usuario->rol->roles }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}"><i
                                                class="fas fa-edit mx-3"></i></a>
                                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/filtrosCrud.js') }}"></script>

</body>

</html>
