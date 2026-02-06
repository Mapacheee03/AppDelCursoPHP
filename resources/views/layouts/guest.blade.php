<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 to-indigo-100">
            <!-- Logo y nombre de la app -->
            <div class="mb-8 text-center">
                <a href="/" class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ config('app.name') }}</h1>
                    <p class="text-gray-600 mt-2">Sistema de gestión de inventario</p>
                </a>
            </div>

            <!-- Contenido de autenticación -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>

            <!-- Enlaces adicionales -->
            <div class="mt-8 text-center text-gray-600 text-sm">
                <p>
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-900">
                            ¿Ya tienes cuenta? Inicia sesión
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <span class="mx-2">•</span>
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-900">
                            ¿No tienes cuenta? Regístrate
                        </a>
                    @endif
                </p>
            </div>

            <!-- Footer -->
            <div class="mt-12 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
                <p class="mt-2">Laravel {{ app()->version() }} • PHP {{ PHP_VERSION }}</p>
            </div>
        </div>
    </body>
</html>