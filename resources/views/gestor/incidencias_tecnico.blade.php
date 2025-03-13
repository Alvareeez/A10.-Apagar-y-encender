<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidencias del Técnico</title>
    <link href="{{ asset('css/gestor.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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
        <a href="{{ route('gestor.dashboard') }}"><button class="button">Inicio</button></a>
        <a href="{{ route('gestor.incidencias') }}"><button class="button">Incidencias</button></a>
        <a href="{{ route('gestor.tecnicos') }}"><button class="button">Técnicos</button></a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="button-logout">Cerrar sesión</button>
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
                            <span>Prioridad: {{ $incidencia->prioridad_nombre }}</span>
                            <br>
                            <br>
                            <span>Estado: {{ $incidencia->estado_nombre }}</span>
                        </div>
                        <a href="{{ route('gestor.detalles_incidencia', $incidencia->id) }}"><button class="btn btn-success">Ver Detalles</button></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.getElementById('hamburger');
            sidebar.classList.toggle('visible');
            sidebar.classList.toggle('hidden');
            hamburger.style.zIndex = sidebar.classList.contains('visible') ? '1001' : '1000';
        }
    </script>
    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
