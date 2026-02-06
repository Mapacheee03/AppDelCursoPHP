@extends('layouts.app')

@section('title', 'Mi Vista Personalizada - ' . config('app.name'))

@section('breadcrumbs')
    <li class="flex items-center">
        <span class="text-gray-500">Mi Vista</span>
    </li>
@endsection

@section('header', 'Mi Vista Personalizada')
@section('subheader', 'Esta es una vista creada completamente desde cero')

@section('content')
    <div class="text-center py-12">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-6">
            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        
        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            ¡Vista creada exitosamente!
        </h2>
        
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
            Has creado una vista Blade completa utilizando el layout principal. 
            Esta página hereda todos los estilos, navegación y estructura del archivo 
            <code class="bg-gray-100 px-2 py-1 rounded">resources/views/layouts/app.blade.php</code>
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-50 p-6 rounded-lg">
                <h3 class="font-semibold text-blue-700 mb-2">Características</h3>
                <ul class="text-left text-gray-700 space-y-2">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Layout principal reutilizable
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Navegación responsive
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Sistema de mensajes flash
                    </li>
                </ul>
            </div>
            
            <div class="bg-green-50 p-6 rounded-lg">
                <h3 class="font-semibold text-green-700 mb-2">Tecnologías</h3>
                <ul class="text-left text-gray-700 space-y-2">
                    <li class="flex items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                        Laravel {{ app()->version() }}
                    </li>
                    <li class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                        Tailwind CSS v4
                    </li>
                    <li class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        MySQL 8.4
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Ir al Dashboard
            </a>
            
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center justify-center px-6 py-3 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Ver Productos
            </a>
        </div>
    </div>
@endsection