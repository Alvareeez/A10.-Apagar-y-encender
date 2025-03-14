<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Incidencia</title>
    <link href="{{ asset('css/cliente.css') }}" rel="stylesheet">
    <script src="{{ asset('js/validacioncliente.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <a href="{{ url('crearincidencias') }}" class="button">Crear Incidencias</a>
        <a href="{{ url('misincidencias') }}" class="button">Mis Incidencias</a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout">Cerrar sesión</button>
        </form>
    </div>
    <div class="content">
        <h1>Crear Incidencia</h1>
        <form action="{{ route('incidencias.store') }}" method="POST" enctype="multipart/form-data" id="incidenciaForm">
            @csrf
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" onblur="validateField(this)">
                <div id="tituloError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" onblur="validateField(this)">
                <div id="descripcionError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria" onblur="validateField(this)">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                    @endforeach
                </select>
                <div id="categoriaError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="subcategoria">Subcategoría:</label>
                <select id="subcategoria" name="subcategoria" onblur="validateField(this)">
                    @foreach($subcategorias as $subcategoria)
                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->subcategoria }}</option>
                    @endforeach
                </select>
                <div id="subcategoriaError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="comentario">Comentario:</label>
                <textarea id="comentario" name="comentario" rows="4" onblur="validateField(this)"></textarea>
                <div id="comentarioError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" onblur="validateField(this)">
                <div id="imagenError" class="error-message"></div>
            </div>
            <div class="form-group">
                <button type="submit" id="submitButton">Enviar Incidencia</button>
            </div>            
        </form>        
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('visible');
            sidebar.classList.toggle('hidden');
        }
    </script>
</body>
</html>
