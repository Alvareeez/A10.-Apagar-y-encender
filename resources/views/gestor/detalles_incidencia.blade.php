<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Incidencia</title>
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
            <h1>Detalles de la Incidencia</h1>
            <div class="incidencia-detalles">
                <h3>{{ $incidencia->titulo }}</h3>
                <p>{{ $incidencia->descripcion }}</p>
                <div class="info">
                    <span>Estado actual: {{ $incidencia->estado }}</span>
                    <span>Fecha de inicio: {{ $incidencia->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="imagenes">
                    <h4>Imágenes:</h4>
                    @foreach ($incidencia->imagenes as $imagen)
                    <img src="{{ asset('storage/' . $imagen->ruta) }}" alt="Imagen de la incidencia">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>