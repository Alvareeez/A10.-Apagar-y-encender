<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Gestor</title>
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
            <h1>Panel del Gestor</h1>

            <!-- Filtros -->
            <div class="filtros">
                <form action="{{ route('gestor.dashboard') }}" method="GET" class="flex gap-4">
                    <div>
                        <label for="prioridad">Filtrar por prioridad:</label>
                        <select name="prioridad" id="prioridad">
                            <option value="">Todas</option>
                            <option value="alta">Alta</option>
                            <option value="media">Media</option>
                            <option value="baja">Baja</option>
                        </select>
                    </div>
                    <div>
                        <label for="estado">Filtrar por estado:</label>
                        <select name="estado" id="estado">
                            <option value="">Todos</option>
                            <option value="{{ \App\Models\Incidencia::ESTADO_ABIERTA }}">Abierta</option>
                            <option value="{{ \App\Models\Incidencia::ESTADO_ASIGNADA }}">Asignada</option>
                            <option value="{{ \App\Models\Incidencia::ESTADO_EN_PROGRESO }}">En progreso</option>
                            <option value="{{ \App\Models\Incidencia::ESTADO_RESUELTA }}">Resuelta</option>
                            <option value="{{ \App\Models\Incidencia::ESTADO_CERRADA }}">Cerrada</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit">Filtrar</button>
                    </div>
                </form>
            </div>

            <!-- Lista de Incidencias -->
            <div>
                <h2>Incidencias</h2>
                <div class="space-y-4">
                    @foreach ($incidencias as $incidencia)
                    <div class="incidencia-card">
                        <h3>{{ $incidencia->titulo }}</h3>
                        <p>{{ $incidencia->descripcion }}</p>
                        <div class="info">
                            <span>Prioridad: {{ $incidencia->prioridad }}</span>
                            <span>Estado: {{ $incidencia->estado }}</span>
                        </div>
                        <div>
                            <form action="{{ route('gestor.incidencia.asignar', $incidencia->id) }}" method="POST">
                                @csrf
                                <select name="tecnico_id">
                                    <option value="">Seleccionar técnico</option>
                                    @foreach ($tecnicos as $tecnico)
                                    <option value="{{ $tecnico->id }}">{{ $tecnico->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit">Asignar a Técnico</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>