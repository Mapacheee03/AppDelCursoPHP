@extends('layouts.app')

@section('title', 'Nueva Categoría - ' . config('app.name'))

@section('breadcrumbs')
    <li class="flex items-center">
        <a href="{{ route('categories.index') }}" class="text-blue-500 hover:text-blue-700">Categorías</a>
        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </li>
    <li class="flex items-center">
        <span class="text-gray-500">Nueva Categoría</span>
    </li>
@endsection

@section('header', 'Crear Nueva Categoría')
@section('subheader', 'Organiza tus productos por categorías')

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- Tarjeta principal del formulario -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
            <!-- Encabezado -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900">
                    <svg class="w-6 h-6 inline-block mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Información de la Categoría
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    Completa los campos para crear una nueva categoría
                </p>
            </div>

            <!-- Formulario -->
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                
                <div class="p-6">
                    <!-- Mensajes de error -->
                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <h4 class="font-medium text-red-700">Por favor corrige los siguientes errores:</h4>
                            </div>
                            <ul class="mt-2 text-sm text-red-600 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Nombre -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nombre de la Categoría *
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               required
                               placeholder="Ej: Electrónica, Ropa, Hogar">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            Este nombre será visible para los usuarios
                        </p>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Descripción
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                  placeholder="Describe esta categoría...">{{ old('description') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">
                            Opcional. Puedes agregar detalles sobre los tipos de productos en esta categoría
                        </p>
                    </div>

                    <!-- Estado -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex items-center h-5">
                                <input type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            </div>
                            <label for="is_active" class="ml-3 text-sm text-gray-700">
                                <span class="font-medium">Categoría Activa</span>
                                <p class="text-gray-500">La categoría será visible al crear productos</p>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Pie del formulario -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600">
                            Los campos marcados con * son obligatorios
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('categories.index') }}" 
                           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Crear Categoría
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Información útil -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h4 class="font-medium text-blue-700">Consejos para crear categorías</h4>
                    <ul class="mt-2 text-sm text-blue-600 list-disc list-inside space-y-1">
                        <li>Usa nombres claros y descriptivos</li>
                        <li>Organiza las categorías de forma lógica para tu negocio</li>
                        <li>Mantén las categorías inactivas cuando no las uses temporalmente</li>
                        <li>Puedes editar las categorías en cualquier momento</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection