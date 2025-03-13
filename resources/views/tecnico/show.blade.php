<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Detalls de l'Incidència</h1>
    
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold">{{ $incidencia->titulo }}</h2>
            <p class="text-gray-600">{{ $incidencia->descripcion }}</p>
            <p><strong>Estado:</strong> {{ $incidencia->estado ? $incidencia->Estado->estado : 'Sense estat' }}</p>
            <p><strong>Prioridad:</strong> {{ $incidencia->prioridad }}</p>
            <p><strong>Fecha de creación:</strong> {{ $incidencia->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Fecha de resolución:</strong> {{ $incidencia->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    
        <a href="{{ route('tecnico.dashboard') }}" class="text-blue-600 hover:text-blue-800 mt-4 inline-block">Tornar al Dashboard</a>
    </div>
    
</body>
</html>