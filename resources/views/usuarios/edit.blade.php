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
    <div class="container-fuera">
        <div class="container-dentro">
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="name">Nombre de usuario</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ old('name', $usuario->name) }}">

                <label for="seu">Sede</label>
                <select id="seu" name="seu" class="form-control">
                    @foreach ($seus as $seu)
                        <option value="{{ $seu->id }}"
                            {{ old('seu', $usuario->seu) == $seu->id ? 'selected' : '' }}>
                            {{ $seu->seus }}
                        </option>
                    @endforeach
                </select>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="{{ old('email', $usuario->email) }}">

                <label for="role">Rol</label>
                <select id="role" name="role" class="form-control">
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}"
                            {{ old('role', $usuario->role) == $rol->id ? 'selected' : '' }}>
                            {{ $rol->roles }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary mt-3">Actualizar Usuario</button>
            </form>
        </div>
    </div>
</body>

</html>
