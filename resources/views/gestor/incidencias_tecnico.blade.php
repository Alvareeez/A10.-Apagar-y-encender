<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidencias de {{ $tecnico->name }}</title>
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
            <h1>Incidencias de {{ $tecnico->name }}</h1>
            <div class="space-y-4">
                @foreach ($incidencias as $incidencia)
                <div class="incidencia-card">
                    <h3>{{ $incidencia->titulo }}</h3>
                    <p>{{ $incidencia->descripcion }}</p>
                    <div class="info">
                        <span>Estado: {{ $incidencia->estado }}</span>
                        <span>Fecha de inicio: {{ $incidencia->created_at->format('d/m/Y') }}</span>
                    </div>
                    <a href="{{ route('gestor.detalles_incidencia', $incidencia->id) }}"><button>Ver detalles</button></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>