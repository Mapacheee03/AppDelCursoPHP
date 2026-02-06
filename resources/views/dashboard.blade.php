@extends('layouts.app')

@section('content')
    <div class="py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">¡Bienvenido al Dashboard!</h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Tarjeta 1 -->
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                        <h3 class="text-lg font-semibold text-blue-800 mb-2">Usuario</h3>
                        <p class="text-gray-700">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="bg-green-50 p-6 rounded-lg border border-green-100">
                        <h3 class="text-lg font-semibold text-green-800 mb-2">Fecha y Hora</h3>
                        <p class="text-gray-700">{{ now()->format('d/m/Y') }}</p>
                        <p class="text-sm text-gray-600">{{ now()->format('h:i A') }}</p>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="bg-purple-50 p-6 rounded-lg border border-purple-100">
                        <h3 class="text-lg font-semibold text-purple-800 mb-2">Acciones</h3>
                        <div class="space-y-2">
                            <a href="{{ route('categories.index') }}" class="block text-purple-600 hover:text-purple-800">
                                Categorías
                            </a>
                            <a href="{{ route('products.index') }}" class="block text-purple-600 hover:text-purple-800">
                                Productos
                            </a>

                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Resumen rápido</h2>
                    <p class="text-gray-600">
                        Has iniciado sesión correctamente en el sistema. Desde aquí puedes gestionar tus productos,
                        categorías y configurar tu perfil de usuario.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
