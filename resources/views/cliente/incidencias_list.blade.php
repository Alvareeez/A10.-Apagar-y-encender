@foreach ($incidencias as $incidencia)
    <div class="incidencia">
        <h3>{{ $incidencia->titulo }}</h3>
        <p>{{ $incidencia->descripcion }}</p>
        <p><strong>Categoría:</strong> {{ $incidencia->Categoria->categoria }}</p>
        <p><strong>Subcategoría:</strong> {{ $incidencia->Subcategoria->subcategoria }}</p>
        <p><strong>Comentario:</strong> {{ $incidencia->comentario }}</p>
        <p><strong>Creado por:</strong> {{ $incidencia->creador->name }}</p>
        <p><strong>Técnico Asignado:</strong> {{ $incidencia->tecnico ? $incidencia->tecnico->name : 'No asignado' }}</p>
        <p><strong>Estado:</strong> {{ $incidencia->Estado->estado }}</p>
        <p><strong>Prioridad:</strong> {{ $incidencia->Prioridad->prioridad }}</p>
        @if ($incidencia->imagen)
            <p><strong>Imagen:</strong> <img src="{{ asset('storage/' . $incidencia->imagen) }}" alt="Imagen de la incidencia"></p>
        @endif
        @if($incidencia->tecnico)
            <p><a href="{{ route('incidencias.chat', $incidencia->id) }}" class="button">Hablar con el Técnico</a></p>
        @endif
    </div>
@endforeach