<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Página de inicio">
    <title>Inicio - {{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden p-8 md:p-12 w-full md:w-11/12 max-w-6xl">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-5">Bienvenido, {{ Auth::user()->name }}</h1>
        <p class="text-center text-gray-600">Has iniciado sesión correctamente.</p>
        <form action="{{ route('logout') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                Cerrar sesión
            </button>
        </form>
    </div>
</body>
</html>