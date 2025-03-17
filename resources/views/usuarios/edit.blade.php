<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    @foreach ($usuarios as $usuario)
        <div class="modal fade" id="editUserModal-{{ $usuario->id }}" tabindex="-1"
            aria-labelledby="editUserModalLabel-{{ $usuario->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel-{{ $usuario->id }}">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nombre -->
                            <label for="name-{{ $usuario->id }}">Nombre de usuario</label>
                            <input type="text" id="name-{{ $usuario->id }}" name="name" class="form-control"
                                value="{{ old('name', $usuario->name) }}">
                            <div class="error-message text-danger mt-1"></div>

                            <!-- Sede -->
                            <label for="seu-{{ $usuario->id }}">Sede</label>
                            <select id="seu-{{ $usuario->id }}" name="seu" class="form-control w-100">
                                <option value="">Seleccione una sede</option>
                                @foreach ($seus as $seu)
                                    <option value="{{ $seu->id }}"
                                        {{ old('seu', $usuario->seu) == $seu->id ? 'selected' : '' }}>
                                        {{ $seu->seus }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="error-message text-danger mt-1"></div>

                            <!-- Email -->
                            <label for="email-{{ $usuario->id }}">Email</label>
                            <input type="email" id="email-{{ $usuario->id }}" name="email" class="form-control"
                                value="{{ old('email', $usuario->email) }}">
                            <div class="error-message text-danger mt-1"></div>

                            <!-- Rol -->
                            <label for="role-{{ $usuario->id }}">Rol</label>
                            <select id="role-{{ $usuario->id }}" name="role" class="form-control w-100">
                                <option value="">Seleccione un rol</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}"
                                        {{ old('role', $usuario->role) == $rol->id ? 'selected' : '' }}>
                                        {{ $rol->roles }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="error-message text-danger mt-1"></div>

                            <div class="d-flex flex-column justify-content-center">
                                <button type="submit" class="btn btn-primary mt-3">Actualizar Usuario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Importar el archivo de validaciones -->
    <script src="{{ asset('js/validacionesCrud.js') }}"></script>
</body>

</html>
