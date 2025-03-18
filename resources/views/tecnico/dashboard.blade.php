<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tècnic</title>
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
</head>
<body>
    <div class="hamburger" id="hamburger" onclick="toggleSidebar()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="sidebar hidden" id="sidebar">
        <div class="profile-pic" style="background-image: url('{{ Storage::url(Auth::user()->profile_photo) }}');" onclick="window.location.href='{{ url('tecnico/perfil') }}'"></div>
        <div class="username">{{ Auth::user()->name }}</div>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout">Cerrar sesión</button>
        </form>
    </div>

    <div class="content">
        <div class="container">
            <h1>Dashboard Tècnic</h1>

            <!-- Filtros -->
            <div class="filtros">
                <form id="filter-form">
                    <label for="search">Buscar por título:</label>
                    <input type="text" id="search" name="search" placeholder="Escribe el título">

                    <label for="filter">Filtrar por estado:</label>
                    <select id="filter" name="filter">
                        <option value="Todas">Todas</option>
                        <option value="Asignada">Asignada</option>
                        <option value="En trabajo">En trabajo</option>
                        <option value="Resuelta">Resuelta</option>
                    </select>
                </form>
            </div>

            <!-- Contenedor para mostrar las incidencias filtradas -->
            <div id="incidencies-container">
                @include('tecnico.incidencias-list', ['incidencies' => $incidencies])
            </div>
        </div>
    </div>

    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluir el archivo JavaScript externo -->
    <script src="{{ asset('js/filtros.js') }}"></script>
</body>
</html>