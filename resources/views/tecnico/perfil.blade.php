<!-- filepath: resources/views/tecnico/perfil.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Técnico</title>
<link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
</head>
<body>
    <div class="hamburger" onclick="toggleSidebar()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="sidebar hidden" id="sidebar">
        <div class="profile-pic" style="background-image: url('{{ Storage::url(Auth::user()->profile_photo) }}');" onclick="window.location.href='{{ url('tecnico/perfil') }}'"></div>
        <div class="username">{{ Auth::user()->name }}</div>
        <a href="{{ route('tecnico.dashboard') }}" class="button">Dashboard</a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout">Cerrar sesión</button>
        </form>

    </div>
    <div class="content">
        <h1>Perfil del Técnico</h1>
        <form action="{{ route('tecnico.perfil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="profile_photo">Foto de Perfil:</label>
                <input type="file" id="profile_photo" name="profile_photo" accept="image/*">
            </div>
            <div class="form-group">
                <button type="submit">Actualizar Foto de Perfil</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/hamburger.js') }}"></script>
</body>
</html>