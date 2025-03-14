<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/cliente.css') }}" rel="stylesheet">

    <title>Panel de Cliente</title>
</head>
<body>
    <div class="hamburger" id="hamburger" onclick="toggleSidebar()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="sidebar hidden" id="sidebar">
        <div class="profile-pic" style="background-image: url('{{ Storage::url(Auth::user()->profile_photo) }}');" onclick="window.location.href='{{ url('perfil') }}'"></div>
        <div class="username">{{ Auth::user()->name }}</div>
        <a href="{{ url('crearincidencias') }}" class="button">Crear Incidencias</a>
        <a href="{{ url('misincidencias') }}" class="button">Mis Incidencias</a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout">Cerrar sesión</button>
        </form>
    </div>
    <div class="content">
        <h1>Bienvenido, Cliente</h1>
        <p>Esta es tu página de inicio.</p>
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