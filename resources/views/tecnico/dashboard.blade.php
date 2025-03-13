<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tècnic</title>
    <link rel="stylesheet" href="{{ asset('css/gestor.css') }}">
</head>
<body>
    <div class="sidebar">
        <img src="{{ asset('img/logo_empresa.png') }}" alt="Logo Empresa">
        <h2>Bienvenido, {{ auth()->user()->name }}</h2>
        <button onclick="location.href='{{ route('tecnico.dashboard') }}'">Inici</button>
        <button onclick="location.href='{{ route('logout') }}'" class="logout">Tancar Sessió</button>
    </div>

    <div class="content">
        <div class="container">
            <h1>Dashboard Tècnic</h1>

            <!-- Filtros -->
            <div class="filtros">
                <form action="{{ route('tecnico.incidencia.filter') }}" method="GET">
                    <label for="filter">Filtrar per estado:</label>
                    <select id="filter" name="filter">
                        <option value="all">Todas</option>
                        <option value="asignada">Asignada</option>
                        <option value="en_trabajo">En trabajo</option>
                        <option value="resuelta">Resuleta</option>
                    </select>
                    <button type="submit">Aplicar Filtro</button>
                </form>
            </div>

            <!-- Llista d'incidències -->
            
            @forelse ($incidencies as $incidencia)
                <div class="incidencia-card">
                    <h3>{{ $incidencia->titulo }}</h3>
                    <p>{{ $incidencia->descripcion }}</p>
                    <div class="info">
                        <span><strong>Estado:</strong> {{ $incidencia->Estado->estado ?? 'No disponible' }}</span>
                        <span><strong>Prioridad:</strong> {{ $incidencia->Prioridad->prioridad ?? 'No disponible' }}</span>
                        <span><strong>Fecha de creación:</strong> {{ $incidencia->created_at->format('d/m/Y H:i') }}</span>
                    </div>

                    <!-- Accions -->
                    <div>
                        <a href="{{ route('tecnico.incidencia.show', $incidencia->id) }}">Ver detalles</a>
                        @if ($incidencia->Estado->estado === 'Asignada')
                            <form action="{{ route('tecnico.incidencia.start', $incidencia->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit">Comenzar</button>
                            </form>
                        @endif
                        @if ($incidencia->Estado->estado === 'En trabajo')
                            <form action="{{ route('tecnico.incidencia.resolve', $incidencia->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit">Marcar como resuelta</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p>No hay incidencias disponibles.</p>
            @endforelse
        </div>
    </div>
</body>
</html>