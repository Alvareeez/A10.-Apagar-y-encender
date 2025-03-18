<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Incidencias</title>
    <link href="{{ asset('css/cliente.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="hamburger" onclick="toggleSidebar()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="sidebar hidden" id="sidebar">
        @if(Auth::user()->profile_photo)
            <div class="profile-pic" style="background-image: url('{{ Storage::url(Auth::user()->profile_photo) }}');" onclick="window.location.href='{{ url('perfil') }}'"></div>
        @else
            <div class="profile-pic"></div>
        @endif
        <div class="username">{{ Auth::user()->name }}</div>
        <a href="{{ url('cliente/dashboard') }}" class="button">Inicio</a>
        <a href="{{ url('crearincidencias') }}" class="button">Crear Incidencias</a>
        <a href="{{ url('misincidencias') }}" class="button">Mis Incidencias</a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout">Cerrar sesión</button>
        </form>
    </div>
    <div class="content">
        <h1>Mis Incidencias</h1>
        <div class="filters">
            <input type="text" id="titulo" placeholder="Buscar por título">
            <select id="categoria">
                <option value="">Todas las categorías</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                @endforeach
            </select>
            <select id="subcategoria">
                <option value="">Todas las subcategorías</option>
                @foreach($subcategorias as $subcategoria)
                    <option value="{{ $subcategoria->id }}">{{ $subcategoria->subcategoria }}</option>
                @endforeach
            </select>
            <select id="tecnico">
                <option value="">Todos los técnicos</option>
                @foreach($tecnicos as $tecnico)
                    <option value="{{ $tecnico->id }}">{{ $tecnico->name }}</option>
                @endforeach
            </select>
            <select id="estado">
                <option value="">Todos los estados</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                @endforeach
            </select>
            <select id="prioridad">
                <option value="">Todas las prioridades</option>
                @foreach($prioridades as $prioridad)
                    <option value="{{ $prioridad->id }}">{{ $prioridad->prioridad }}</option>
                @endforeach
            </select>
        </div>
        <div id="incidencias-list">
            @foreach ($incidencias as $incidencia)
                <div class="incidencia">
                    <h3>{{ $incidencia->titulo }}</h3>
                    <p>{{ $incidencia->descripcion }}</p>
                    <p><strong>Categoría:</strong> {{ $incidencia->Categoria->categoria }}</p>
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
        </div>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('visible');
            sidebar.classList.toggle('hidden');
        }

        $(document).ready(function() {
            $('.filters input, .filters select').on('change keyup', function() {
                fetchIncidencias();
            });

            function fetchIncidencias() {
                $.ajax({
                    url: '{{ route("incidencias.filter") }}',
                    method: 'GET',
                    data: {
                        titulo: $('#titulo').val(),
                        categoria: $('#categoria').val(),
                        subcategoria: $('#subcategoria').val(),
                        tecnico: $('#tecnico').val(),
                        estado: $('#estado').val(),
                        prioridad: $('#prioridad').val()
                    },
                    success: function(response) {
                        $('#incidencias-list').html(response);
                    }
                });
            }
        });
    </script>
</body>
</html>