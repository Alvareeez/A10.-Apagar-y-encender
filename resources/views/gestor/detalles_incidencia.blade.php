<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Incidencia</title>
    <link href="{{ asset('css/gestor.css') }}" rel="stylesheet">
</head>

<body>
    <div class="hamburger" id="hamburger" onclick="toggleSidebar()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="sidebar" id="sidebar">
        <div class="profile-pic" style="background-image: url('{{ Storage::url(Auth::user()->profile_photo) }}');"
            onclick="window.location.href='{{ url('/gestor/perfil') }}'"></div>
        <div class="username">{{ Auth::user()->name }}</div>
        <a href="{{ route('gestor.dashboard') }}" class="button">Inicio</a>
        <a href="{{ route('gestor.incidencias') }}" class="button">Incidencias</a>
        <a href="{{ route('gestor.tecnicos') }}" class="button">Técnicos</a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="button-logout">Cerrar sesión</button>
        </form>
    </div>
    <div class="content">
        <div class="container">
            <h1>Detalles de la Incidencia</h1>
            <div class="incidencia-card">
                <p><strong>Incidencia: </strong> {{ $incidencia->titulo }}</p>
                <p><strong>Descripción de la incidencia: </strong> {{ $incidencia->descripcion }}</p>
                <div class="info">
                    <span><strong> Prioridad: </strong> {{ $incidencia->prioridad_nombre }}</span>
                    <br>
                    <br>
                    <span><strong>Estado: </strong> {{ $incidencia->estado_nombre }}</span>
                    <br>
                    <br>
                    <p><strong>Categoría:</strong> {{ $incidencia->Categoria->categoria }}</p>
                    <p><strong>Subcategoría:</strong> {{ $incidencia->Subcategoria->subcategoria }}</p>
                    <p><strong>Comentario:</strong> {{ $incidencia->comentario }}</p>
                    <p><strong>Creado por:</strong> {{ $incidencia->creador->name }}</p>
                    <p><strong>Técnico Asignado:</strong>
                        {{ $incidencia->tecnico ? $incidencia->tecnico->name : 'No asignado' }}</p>
                    <p><strong>Estado:</strong> {{ $incidencia->Estado->estado }}</p>
                    <p><strong>Prioridad:</strong> {{ $incidencia->Prioridad->prioridad }}</p>
                </div>
                @if ($incidencia->imagen)
                    <div class="imagen">
                        <img src="{{ Storage::url($incidencia->imagen) }}" alt="Imagen de la incidencia">
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('js/hamburger.js') }}"></script>
</body>

</html>
