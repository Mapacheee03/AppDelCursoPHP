@extends('layouts.app')

@section('title', 'Crear Producto - ' . config('app.name'))

@section('breadcrumbs')
    <li class="flex items-center">
        <a href="{{ route('products.index') }}" class="hover:text-blue-500">Productos</a>
        <svg class="fill-current w-3 h-3 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
            <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
        </svg>
    </li>
    <li class="flex items-center">
        <span class="text-gray-500">Crear</span>
    </li>
@endsection

@section('header', 'Crear Nuevo Producto')
@section('subheader', 'Agrega un nuevo producto al inventario')

@section('content')
    <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Card de información básica -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Información Básica</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre del Producto *
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name"
                           value="{{ old('name') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categoría -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Categoría
                    </label>
                    <select name="category_id" 
                            id="category_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleccionar categoría...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Card de detalles -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Detalles del Producto</h3>
            
            <!-- Descripción -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Descripción
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Precio -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                        Precio *
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-500">$</span>
                        <input type="number" 
                               name="price" 
                               id="price"
                               step="0.01"
                               min="0"
                               value="{{ old('price') }}"
                               class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 @enderror"
                               required>
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
                        Stock Inicial *
                    </label>
                    <input type="number" 
                           name="stock" 
                           id="stock"
                           min="0"
                           value="{{ old('stock', 0) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('stock') border-red-500 @enderror"
                           required>
                    @error('stock')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Estado</label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="radio" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active', 1) == 1 ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <span class="ml-2 text-gray-700">Activo</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" 
                                   name="is_active" 
                                   value="0"
                                   {{ old('is_active') == 0 ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <span class="ml-2 text-gray-700">Inactivo</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="flex justify-between items-center pt-6 border-t">
            <a href="{{ route('products.index') }}" 
               class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                Cancelar
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Crear Producto
            </button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    // Validación en tiempo real
    document.addEventListener('DOMContentLoaded', function() {
        const priceInput = document.getElementById('price');
        const stockInput = document.getElementById('stock');
        
        priceInput.addEventListener('input', function(e) {
            let value = parseFloat(e.target.value);
            if (value < 0) {
                e.target.value = 0;
            }
        });
        
        stockInput.addEventListener('input', function(e) {
            let value = parseInt(e.target.value);
            if (value < 0 || isNaN(value)) {
                e.target.value = 0;
            }
        });
    });
</script>
@endpush