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
            <h1>Detalles de la Incidencia</h1>
            <div class="incidencia-card">
                <h3>{{ $incidencia->titulo }}</h3>
                <p>{{ $incidencia->descripcion }}</p>
                <div class="info">
                    <span>Prioridad: {{ $incidencia->prioridad_nombre }}</span>
                    <br>
                    <br>
                    <span>Estado: {{ $incidencia->estado_nombre }}</span>
                </div>
                @if ($incidencia->imagen)
                    <div class="imagen">
                        <img src="{{ Storage::url($incidencia->imagen) }}" alt="Imagen de la incidencia">
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="{{asset('js/hamburger.js')}}"></script>
</body>
</html>