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
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        body { background-color: #f9fafb; }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <!-- Simple Navbar -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">
                            {{ config('app.name', 'MiApp') }}
                        </a>
                    </div>

                    <div class="flex items-center">
                        @auth
                            <!-- Aquí va TU código de navbar-auth -->
                            @if(file_exists(resource_path('views/partials/navbar-auth.blade.php')))
                                @include('partials.navbar-auth')
                            @else
                                <!-- Fallback simple -->
                                <div class="flex items-center space-x-4">
                                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @else
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">
                                    Login
                                </a>
                                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                                    Register
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>