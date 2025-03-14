<!-- filepath: c:\wamp64\www\M12\A10.-Apagar-y-encender\resources\views\cliente\perfil.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Cliente</title>
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            background-color: #ccc;
            padding: 20px;
            width: 250px;
            height: 100vh;
            box-sizing: border-box;
            transition: transform 0.3s ease;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #fff;
            margin-bottom: 10px;
            cursor: pointer;
            background-size: cover;
            background-position: center;
        }
        .username {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            background-color: #87CEEB;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group button {
            padding: 10px;
            background-color: #87CEEB;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #00BFFF;
        }
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            margin: 10px;
            z-index: 1001; /* Ensure the hamburger is above the sidebar */
        }
        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 4px 0;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                z-index: 1000;
                height: 100%;
                transform: translateX(-100%);
            }
            .sidebar.visible {
                transform: translateX(0);
            }
            .hamburger {
                display: flex;
            }
        }
    </style>
</head>
<body>
    <div class="hamburger" onclick="toggleSidebar()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="sidebar hidden" id="sidebar">
        <div class="profile-pic" style="background-image: url('{{ Storage::url(Auth::user()->profile_photo) }}');" onclick="window.location.href='{{ url('perfil') }}'"></div>
        <div class="username">{{ Auth::user()->name }}</div>
        <a href="{{ url('crearincidencias') }}" class="button">Crear Incidencias</a>
        <a href="{{ url('misincidencias') }}" class="button">Mis Incidencias</a>
    </div>
    <div class="content">
        <h1>Perfil del Cliente</h1>
        <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
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
    <script src="{{asset('js/hamburger.js')}}"></script>
</body>
</html>