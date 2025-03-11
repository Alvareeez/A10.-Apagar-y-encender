<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Cliente</title>
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
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="profile-pic" style="background-image: url('{{ Storage::url(Auth::user()->profile_photo) }}');" onclick="window.location.href='{{ url('perfil') }}'"></div>
        <div class="username">{{ Auth::user()->name }}</div>
        <a href="{{ url('crearincidencias') }}" class="button">Crear Incidencias</a>
        <a href="{{ url('misincidencias') }}" class="button">Mis Incidencias</a>
    </div>
    <div class="content">
        <h1>Bienvenido, Cliente</h1>
        <p>Esta es tu página de inicio.</p>
    </div>
</body>
</html>