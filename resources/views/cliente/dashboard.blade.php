<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Cliente</title>
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
            transition: transform 0.3s ease;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #fff;
            margin-bottom: 10px;
            cursor: pointer;
            background-size: cover;
            background-position: center;
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
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            margin: 10px;
            z-index: 1001; /* Ensure the hamburger is above the sidebar */
        }
        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 4px 0;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                z-index: 1000;
                height: 100%;
                transform: translateX(-100%);
            }
            .sidebar.visible {
                transform: translateX(0);
            }
            .hamburger {
                display: flex;
            }
        }
    </style>
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