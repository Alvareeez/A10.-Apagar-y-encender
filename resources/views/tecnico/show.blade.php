<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
</head>
<body>
    <div class="hamburger" id="hamburger" onclick="toggleSidebar()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="sidebar hidden" id="sidebar">
        <div class="profile-pic" style="background-image: url('{{ Storage::url(Auth::user()->profile_photo) }}');" onclick="window.location.href='{{ url('perfil') }}'"></div>
        <div class="username">{{ Auth::user()->name }}</div>
        <a href="{{ route('tecnico.dashboard') }}" class="button">Dashboard</a>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout">Cerrar sesión</button>
        </form>
    </div>

    <div class="content mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Detalls de l'Incidència</h1>
    
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold">{{ $incidencia->titulo }}</h2>
            <p class="text-gray-600">{{ $incidencia->descripcion }}</p>
            <p><strong>Estado:</strong> {{ $incidencia->estado ? $incidencia->Estado->estado : 'Sense estat' }}</p>
            <p><strong>Prioridad:</strong> {{ $incidencia->prioridad ? $incidencia->Prioridad->prioridad : 'Sense estat'}}</p>
            <p><strong>Fecha de creación:</strong> {{ $incidencia->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Fecha de resolución:</strong> {{ $incidencia->updated_at->format('d/m/Y H:i') }}</p>
        </div>
        </div>    
</body>
</html>