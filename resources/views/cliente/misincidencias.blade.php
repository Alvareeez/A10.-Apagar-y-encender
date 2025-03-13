<!-- filepath: c:\wamp64\www\M12\A10.-Apagar-y-encender\resources\views\cliente\misincidencias.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Incidencias</title>
    <link href="{{ asset('css/cliente.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background-color: #ccc;
            padding: 20px;
            width: 250px;
            height: 100vh;
            box-sizing: border-box;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #fff;
            margin-bottom: 10px;
        }

        .username {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            background-color: #87CEEB;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .incidencia {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .incidencia h3 {
            margin: 0 0 10px 0;
        }

        .incidencia img {
            max-width: 20%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        @if (Auth::user()->profile_photo)
            <div class="profile-pic" style="background-image: url('{{ Storage::url(Auth::user()->profile_photo) }}');">
            </div>
        @else
            <div class="profile-pic"></div>
        @endif
        <div class="username">{{ Auth::user()->name }}</div>
        <a href="{{ url('crearincidencias') }}" class="button">Crear Incidencias</a>
        <a href="{{ url('misincidencias') }}" class="button">Mis Incidencias</a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout">Cerrar sesión</button>
        </form>
    </div>
    <div class="content">
        <h1>Mis Incidencias</h1>
        @foreach ($incidencias as $incidencia)
            <div class="incidencia">
                <h3>{{ $incidencia->titulo }}</h3>
                <p>{{ $incidencia->descripcion }}</p>
                <p><strong>Subcategoría:</strong> {{ $incidencia->subcategoria }}</p>
                <p><strong>Comentario:</strong> {{ $incidencia->comentario }}</p>
                <p><strong>Creado por:</strong> {{ $incidencia->creador->name }}</p>
                <p><strong>Técnico Asignado:</strong>
                    {{ $incidencia->tecnico ? $incidencia->tecnico->name : 'No asignado' }}</p>
                @if ($incidencia->imagen)
                    <p><strong>Imagen:</strong> <img src="{{ asset('storage/' . $incidencia->imagen) }}"
                            alt="Imagen de la incidencia"></p>
                @endif
            </div>
        @endforeach
    </div>
</body>

</html>
