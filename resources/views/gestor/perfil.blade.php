<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Gestor</title>
    <link href="{{ asset('css/gestor.css') }}" rel="stylesheet">
</head>
<body>
    <div class="hamburger" onclick="toggleSidebar()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="sidebar hidden" id="sidebar">
        <div class="profile-pic" style="background-image: url('{{ Storage::url(Auth::user()->profile_photo) }}');" onclick="window.location.href='{{ url('gestor/perfil') }}'"></div>
        <div class="username">{{ Auth::user()->name }}</div>
        <a href="{{ url('gestor/dashboard') }}" class="button">Inicio</a>
        <a href="{{ url('gestor/incidencias') }}" class="button">Ver Incidencias</a>
        <a href="{{ url('gestor/tecnicos') }}" class="button">Técnicos</a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="button-logout">Cerrar sesión</button>
        </form>
    </div>
    <div class="content">
        <h1>Perfil del Gestor</h1>
        <form action="{{ route('gestor.perfil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="profile_photo">Foto de Perfil:</label>
                <input type="file" id="profile_photo" name="profile_photo" accept="image/*">
            </div>
            <div class="form-group">
                <button type="submit">Actualizar Foto de Perfil</button>
            </div>
        </form>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('visible');
            sidebar.classList.toggle('hidden');
        }
    </script>
</body>
</html>