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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/gestor.css') }}" rel="stylesheet">
</head>

<body>
    <div class="hamburger" id="hamburger" onclick="toggleSidebar()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="sidebar hidden" id="sidebar">
        <div class="profile-pic" style="background-image: url('{{ Storage::url(Auth::user()->profile_photo) }}');"
            onclick="window.location.href='{{ url('/gestor/perfil') }}'"></div>
        <div class="username">{{ Auth::user()->name }}</div>
        <button class="button" data-bs-toggle="modal" data-bs-target="#createUserModal">Crear Usuarios</button>
        {{-- <a href="{{ route('gestor.tecnicos') }}" class="button">Incidéncias</button></a> --}}
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="button-logout">Cerrar sesión</button>
        </form>
    </div>
    <div class="container">
        <h1>Gestionar usuario</h1>
        <div class="d-flex mb-3">
            <div class="input-group me-2">
                <input type="text" id="search" class="form-control" placeholder="Buscar por nombre o email">
                <button class="btn btn-outline-secondary" id="clear-search">X</button>
            </div>
            <div class="input-group me-2">
                <select id="seu" class="form-control">
                    <option value="">Seleccionar Sede</option>
                    @foreach ($seus as $seu)
                        <option value="{{ $seu->id }}" {{ old('seu') == $seu->id ? 'selected' : '' }}>
                            {{ $seu->seus }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-outline-secondary" id="clear-seu">X</button>
            </div>
            <div class="input-group me-2">
                <select id="role" class="form-control">
                    <option value="">Seleccionar Rol</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->roles }}</option>
                    @endforeach
                </select>
                <button class="btn btn-outline-secondary" id="clear-role">X</button>
            </div>
            <button id="clear-all" class="btn btn-outline-danger">Borrar Todos</button>
        </div>
        <table class="table table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Email <button id="sort-email" class="btn btn-link p-0 text-decoration-none">ABC</button></th>
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
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-link" data-bs-toggle="modal"
                                    data-bs-target="#editUserModal-{{ $usuario->id }}">
                                    <i class="fas fa-edit mx-3"></i>
                                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE') <button type="button"
                                            class="btn btn-danger btn-sm delete-button">
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

    <script src="{{ asset('js/filtrosCrud.js') }}"></script>
    <script src="{{ asset('js/hamburger.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.delete-button').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    @include('usuarios.create')
    @include('usuarios.edit')
</body>

</html>
