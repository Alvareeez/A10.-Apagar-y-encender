<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Página de inicio de sesión">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100 p-4">

    <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row w-full md:w-11/12 max-w-6xl">
        <!-- Sección del logo -->
        <div class="w-full md:w-2/5 bg-gray-200 flex items-center justify-center p-8 md:p-10">
            <img src="{{ asset('img/logo_empresa.png') }}" 
                 alt="Logo de la empresa" 
                 class="w-full max-w-sm md:max-w-full object-contain">
        </div>

        <!-- Sección del formulario -->
        <div class="w-full md:w-3/5 p-8 md:p-12">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-5">Iniciar sesión</h2>

            @if (session('status'))
            <div class="bg-green-100 text-green-600 p-3 rounded-lg mb-4">
                {{ session('status') }}
            </div>
            @endif

            <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Correo electrónico
                    </label>
                    <input type="email"
                        id="email"
                        name="email"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">
                    <!-- Mensaje de error para el correo electrónico -->
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Contraseña
                    </label>
                    <input type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                    <!-- Mensaje de error para la contraseña -->
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    Iniciar sesión
                </button>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Incluir el archivo de validaciones -->
    <script src="{{ asset('js/validacionesLogin.js') }}"></script>

    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error de autenticación',
            text: "{{ session('error') }}",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
    </script>
    @endif
</body>

</html>