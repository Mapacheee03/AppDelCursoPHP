@extends('layouts.app')

@section('title', 'Editar Categoría: ' . $category->name . ' - ' . config('app.name'))

@section('breadcrumbs')
    <li class="flex items-center">
        <a href="{{ route('categories.index') }}" class="text-blue-500 hover:text-blue-700">Categorías</a>
        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </li>
    <li class="flex items-center">
        <span class="text-gray-500">Editar {{ Str::limit($category->name, 20) }}</span>
    </li>
@endsection

@section('header', 'Editar Categoría')
@section('subheader', 'Actualiza la información de la categoría')

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- Tarjeta principal del formulario -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
            <!-- Encabezado -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900">
                    <svg class="w-6 h-6 inline-block mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Información de la Categoría
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    ID: {{ $category->id }} | Última actualización: {{ $category->updated_at->format('d/m/Y H:i') }}
                </p>
            </div>

            <!-- Formulario -->
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                
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
                               value="{{ old('name', $category->name) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Descripción
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <!-- Estado -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex items-center h-5">
                                <input type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                                       class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            </div>
                            <label for="is_active" class="ml-3 text-sm text-gray-700">
                                <span class="font-medium">Categoría Activa</span>
                                <p class="text-gray-500">La categoría será visible al crear productos</p>
                            </label>
                        </div>
                    </div>

                    <!-- Información de productos asociados -->
                    @if($category->products()->count() > 0)
                        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-500 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h4 class="font-medium text-yellow-800">Productos Asociados</h4>
                                    <p class="mt-1 text-sm text-yellow-700">
                                        Esta categoría tiene <span class="font-bold">{{ $category->products()->count() }}</span> productos asociados.
                                        Si cambias el nombre, estos productos mantendrán la relación.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
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
                            Actualizar Categoría
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Información adicional -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm text-gray-500">Creado</p>
                        <p class="font-medium">{{ $category->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm text-gray-500">Última actualización</p>
                        <p class="font-medium">{{ $category->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-purple-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm text-gray-500">Slug</p>
                        <p class="font-medium text-sm font-mono">{{ $category->slug }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de productos asociados -->
        @if($category->products()->count() > 0)
            <div class="mt-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-medium text-gray-900">
                        <svg class="w-6 h-6 inline-block mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Productos en esta Categoría ({{ $category->products()->count() }})
                    </h3>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($category->products()->limit(5)->get() as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">
                                        <a href="{{ route('products.show', $product->id) }}" 
                                           class="text-blue-600 hover:text-blue-800 font-medium">
                                            {{ $product->name }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">
                                        ${{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $product->stock }} unidades
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($product->is_active)
                                            <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-green-100 text-green-800">
                                                Activo
                                            </span>
                                        @else
                                            <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-red-100 text-red-800">
                                                Inactivo
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($category->products()->count() > 5)
                        <div class="mt-4 text-center">
                            <a href="{{ route('products.index', ['category_id' => $category->id]) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Ver todos los {{ $category->products()->count() }} productos →
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection