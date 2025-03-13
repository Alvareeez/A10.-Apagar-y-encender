<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Técnicos</title>
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
        <a href="{{ route('gestor.dashboard') }}"><button class="button">Inicio</button></a>
        <a href="{{ route('gestor.incidencias') }}"><button class="button">Incidencias</button></a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="button-logout">Cerrar sesión</button>
        </form>
    </div>
    <div class="content">
        <div class="container">
            <h1>Técnicos</h1>
            <div class="space-y-4">
                @foreach ($tecnicos as $tecnico)
                    <div class="tecnico-card">
                        <h3>{{ $tecnico->name }}</h3>
                        <a href="{{ route('gestor.incidencias_tecnico', $tecnico->id) }}"><button>Ver
                                Incidencias</button></a>
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
</body>

</html>
