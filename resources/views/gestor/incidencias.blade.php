<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidencias</title>
    <link href="{{ asset('css/gestor.css') }}" rel="stylesheet">
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="container mt-4">

            <!-- Lista de Incidencias -->
            <div>
                <h2>Incidencias</h2>
                <div class="list-group">
                    @foreach ($incidencias as $incidencia)
                        <div class="list-group-item">
                            <h3>{{ $incidencia->titulo }}</h3>
                            <p>{{ $incidencia->descripcion }}</p>
                            <div class="info mb-3">
                                <span class="badge 
                                    @if($incidencia->prioridad_nombre == 'Alta') badge-prioridad-alta 
                                    @elseif($incidencia->prioridad_nombre == 'Media') badge-prioridad-media 
                                    @elseif($incidencia->prioridad_nombre == 'Baja') badge-prioridad-baja 
                                    @endif">
                                    Prioridad: {{ $incidencia->prioridad_nombre }}
                                </span>
                                <span class="badge 
                                    @if($incidencia->estado_nombre == 'Sin Asignar') badge-sin-asignar 
                                    @elseif($incidencia->estado_nombre == 'Asignada') badge-asignada 
                                    @elseif($incidencia->estado_nombre == 'En Trabajo') badge-en-trabajo 
                                    @elseif($incidencia->estado_nombre == 'Resuelta') badge-resuelta 
                                    @elseif($incidencia->estado_nombre == 'Cerrada') badge-cerrada 
                                    @endif">
                                    Estado: {{ $incidencia->estado_nombre }}
                                </span>
                            </div>
                            <form action="{{ route('gestor.incidencia.asignar', $incidencia->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="prioridad">Asignar nivel de prioridad:</label>
                                    <select name="prioridad" id="prioridad" class="form-control">
                                        <option value="" disabled>Seleccionar prioridad</option>
                                        <option value="alta">Alta</option>
                                        <option value="media">Media</option>
                                        <option value="baja">Baja</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tecnico_id">Asignar técnico:</label>
                                    <select name="tecnico_id" id="tecnico_id" class="form-control">
                                        <option value="">Seleccionar técnico</option>
                                        @foreach ($tecnicos as $tecnico)
                                            <option value="{{ $tecnico->id }}">{{ $tecnico->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Asignar</button>
                            </form>
                        </div>
                    @endforeach
                </div>
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
