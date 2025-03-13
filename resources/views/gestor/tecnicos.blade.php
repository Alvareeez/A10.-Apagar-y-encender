<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Técnicos</title>
    <link href="{{ asset('css/gestor.css') }}" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <img src="https://via.placeholder.com/80" alt="Gestor">
        <h2>Gestor</h2>
        <a href="{{ route('gestor.dashboard') }}"><button>Ver incidencias</button></a>
        <a href="{{ route('gestor.tecnicos') }}"><button>Técnicos</button></a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout">Cerrar sesión</button>
        </form>
    </div>
    <div class="content">
        <div class="container">
            <h1>Técnicos</h1>
            <div class="space-y-4">
                @foreach ($tecnicos as $tecnico)
                <div class="tecnico-card">
                    <h3>{{ $tecnico->name }}</h3>
                    <a href="{{ route('gestor.incidencias_tecnico', $tecnico->id) }}"><button>Ver Incidencias</button></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>