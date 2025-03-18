@forelse ($incidencies as $incidencia)
    <div class="incidencia">
        <h3>{{ $incidencia->titulo }}</h3>
        <p>{{ $incidencia->descripcion }}</p>
        <div class="info">
            <span><strong>Estado:</strong> {{ $incidencia->Estado->estado ?? 'No disponible' }}</span>
            <span><strong>Prioridad:</strong> {{ $incidencia->Prioridad->prioridad ?? 'No disponible' }}</span>
            <span><strong>Fecha de creación:</strong> {{ $incidencia->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <br>
        <!-- Acciones -->
        <div class="acciones">
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
            <br>
            <a href="{{ route('tecnico.incidencia.show', $incidencia->id) }}">Ver detalles</a>
            <a href="{{ route('incidencias.chat', $incidencia->id) }}">Abrir chat</a>
        </div>
    </div>
@empty
    <p>No hay incidencias disponibles.</p>
@endforelse