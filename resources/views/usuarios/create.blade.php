<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Crear Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuarios.store') }}" method="POST">
                        @csrf
                        <label for="name">Nombre de usuario</label>
                        <input type="text" id="name" name="name" class="form-control">
                        <span id="error_name" class="error-message"></span>
                        <label for="seu">Sede</label>
                        <select id="seu" name="seu" class="form-control w-100">
                            <option value="" selected disabled>Seleccionar una seu</option>
                            @foreach ($seus as $seu)
                                <option value="{{ $seu->id }}" {{ old('seu') == $seu->id ? 'selected' : '' }}>
                                    {{ $seu->seus }}
                                </option>
                            @endforeach
                        </select>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control">

                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" class="form-control">
                        <span id="error_password" class="error-message"></span>

                        <label for="password_confirmation">Confirmar Contraseña:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control">
                        <span id="error_password_confirmation" class="error-message"></span>

                        <label for="role">Rol:</label><br>
                        <select id="role" name="role" class="form-control w-100">
                            <option value="" selected disabled>Seleccionar un rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}" {{ old('role') == $rol->id ? 'selected' : '' }}>
                                    {{ $rol->roles }}
                                </option>
                            @endforeach
                        </select><br>
                        <span id="error_rol" class="error-message"></span>
                        <div class="d-flex flex-column justify-content-center">
                            <button type="submit" class="btn btn-primary">Añadir Nuevo Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('js/validaCreate.js') }}"></script> --}}
</body>

</html>
