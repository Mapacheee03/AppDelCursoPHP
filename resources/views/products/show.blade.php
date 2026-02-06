@extends('layouts.app')

@section('title', $product->name . ' - ' . config('app.name'))

@section('breadcrumbs')
    <li class="flex items-center">
        <a href="{{ route('products.index') }}" class="text-blue-500 hover:text-blue-700">Productos</a>
        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </li>
    <li class="flex items-center">
        <span class="text-gray-500">{{ Str::limit($product->name, 20) }}</span>
    </li>
@endsection

@section('header', 'Detalles del Producto')
@section('subheader', 'Información completa del producto')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Tarjeta principal -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <!-- Encabezado con acciones -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">
                        <svg class="w-6 h-6 inline-block mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Información General
                    </h3>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('products.edit', $product->id) }}" 
                       class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Editar
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('¿Estás seguro de eliminar este producto?')"
                                class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-6">
                <!-- Grid de 2 columnas -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Columna izquierda: Imagen e información básica -->
                    <div class="space-y-6">
                        <!-- Imagen del producto -->
                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                            <div class="text-center">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}"
                                         class="mx-auto h-64 w-64 object-cover rounded-lg shadow-lg">
                                @else
                                    <div class="h-64 w-64 mx-auto bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Información básica -->
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Detalles del Producto
                            </h4>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">ID del Producto</p>
                                    <p class="font-medium">{{ $product->id }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Slug</p>
                                    <p class="font-medium font-mono text-sm">{{ $product->slug }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Estado</p>
                                    <p>
                                        @if($product->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Activo
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                Inactivo
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Categoría</p>
                                    <p>
                                        @if($product->category)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $product->category->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-500">Sin categoría</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna derecha: Información detallada -->
                    <div class="space-y-6">
                        <!-- Nombre y descripción -->
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <div class="mb-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $product->name }}</h4>
                                @if($product->description)
                                    <div class="prose max-w-none">
                                        <p class="text-gray-600 whitespace-pre-line">{{ $product->description }}</p>
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">Sin descripción</p>
                                @endif
                            </div>

                            <!-- Precio y Stock -->
                            <div class="grid grid-cols-2 gap-6">
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm text-blue-500">Precio</p>
                                            <p class="text-2xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-green-50 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm text-green-500">Stock Disponible</p>
                                            <p class="text-2xl font-bold text-gray-900">{{ $product->stock }} unidades</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Barra de stock -->
                            @php
                                $stockPercentage = min(100, ($product->stock / 100) * 100);
                                $stockColor = $product->stock > 50 ? 'bg-green-600' : ($product->stock > 20 ? 'bg-yellow-500' : 'bg-red-600');
                                $stockMessage = $product->stock > 50 ? 'Stock suficiente' : ($product->stock > 20 ? 'Stock medio' : 'Stock bajo');
                            @endphp
                            <div class="mt-6">
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Nivel de Stock</span>
                                    <span>{{ $stockMessage }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="h-2.5 rounded-full {{ $stockColor }}" style="width: {{ $stockPercentage }}%"></div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500 text-right">
                                    {{ $product->stock }} de 100 unidades máximas
                                </p>
                            </div>
                        </div>

                        <!-- Metadatos -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Información del Sistema
                            </h4>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Creado</p>
                                    <p class="font-medium">{{ $product->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="text-xs text-gray-400">{{ $product->created_at->diffForHumans() }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Última actualización</p>
                                    <p class="font-medium">{{ $product->updated_at->format('d/m/Y H:i') }}</p>
                                    <p class="text-xs text-gray-400">{{ $product->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Valor total en inventario -->
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-purple-500">Valor en Inventario</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        ${{ number_format($product->price * $product->stock, 2) }}
                                    </p>
                                    <p class="text-xs text-purple-600">
                                        Precio unitario × Stock disponible
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones adicionales -->
        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('products.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a la lista
            </a>
            
            <div class="flex space-x-3">
                @if($product->category)
                    <a href="{{ route('products.index', ['category_id' => $product->category_id]) }}" 
                       class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Ver productos similares
                    </a>
                @endif
                
                <button onclick="window.print()" 
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Imprimir
                </button>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.prose {
    color: #374151;
    line-height: 1.625;
}

.prose p {
    margin-top: 1em;
    margin-bottom: 1em;
}

@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        font-size: 12pt;
    }
    
    a {
        text-decoration: none !important;
        color: #000 !important;
    }
}
</style>
@endpush