@extends('layouts.app')

@section('title', 'Editar Producto: ' . $product->name . ' - ' . config('app.name'))

@section('breadcrumbs')
    <li class="flex items-center">
        <a href="{{ route('products.index') }}" class="text-blue-500 hover:text-blue-700">Productos</a>
        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </li>
    <li class="flex items-center">
        <span class="text-gray-500">Editar {{ Str::limit($product->name, 20) }}</span>
    </li>
@endsection

@section('header', 'Editar Producto')
@section('subheader', 'Actualiza la información del producto')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Tarjeta principal del formulario -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
            <!-- Encabezado -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900">
                    <svg class="w-6 h-6 inline-block mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Información del Producto
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    ID: {{ $product->id }} | Última actualización: {{ $product->updated_at->format('d/m/Y H:i') }}
                </p>
            </div>

            <!-- Formulario -->
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
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

                    <!-- Grid de 2 columnas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Columna izquierda: Información básica -->
                        <div class="space-y-6">
                            <!-- Nombre -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nombre del Producto *
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $product->name) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                    Descripción
                                </label>
                                <textarea id="description" 
                                          name="description" 
                                          rows="4"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <!-- Precio y Stock -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                                        Precio *
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">$</span>
                                        </div>
                                        <input type="number" 
                                               step="0.01" 
                                               min="0" 
                                               id="price" 
                                               name="price" 
                                               value="{{ old('price', $product->price) }}"
                                               class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                               required>
                                    </div>
                                    @error('price')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
                                        Stock *
                                    </label>
                                    <input type="number" 
                                           min="0" 
                                           id="stock" 
                                           name="stock" 
                                           value="{{ old('stock', $product->stock) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                           required>
                                    @error('stock')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Categoría -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Categoría
                                </label>
                                <select id="category_id" 
                                        name="category_id"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    <option value="">Seleccionar categoría...</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Columna derecha: Imagen y estado -->
                        <div class="space-y-6">
                            <!-- Imagen actual -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    Imagen Actual
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                    @if($product->image)
                                        <div class="mb-4">
                                            <img src="{{ Storage::url($product->image) }}" 
                                                 alt="{{ $product->name }}"
                                                 class="mx-auto h-48 w-48 object-cover rounded-lg shadow-sm">
                                        </div>
                                        <p class="text-sm text-gray-600">
                                            {{ basename($product->image) }}
                                        </p>
                                    @else
                                        <div class="py-12">
                                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-600">
                                                No hay imagen cargada
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Nueva imagen -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nueva Imagen
                                </label>
                                <input type="file" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="mt-1 text-xs text-gray-500">
                                    Formatos: JPEG, PNG, JPG, GIF. Tamaño máximo: 2MB
                                </p>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Estado -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1"
                                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    </div>
                                    <label for="is_active" class="ml-3 text-sm text-gray-700">
                                        <span class="font-medium">Producto Activo</span>
                                        <p class="text-gray-500">El producto será visible para los clientes</p>
                                    </label>
                                </div>
                            </div>

                            <!-- Vista previa de imagen -->
                            <div id="image-preview-container" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    Vista Previa
                                </label>
                                <div class="border-2 border-dashed border-blue-300 rounded-lg p-4 text-center bg-blue-50">
                                    <img id="image-preview" 
                                         class="mx-auto h-48 w-48 object-cover rounded-lg shadow-sm">
                                    <p class="mt-2 text-sm text-blue-600">
                                        Nueva imagen seleccionada
                                    </p>
                                </div>
                            </div>
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
                        <a href="{{ route('products.index') }}" 
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
                            Actualizar Producto
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
                        <p class="font-medium">{{ $product->created_at->format('d/m/Y H:i') }}</p>
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
                        <p class="font-medium">{{ $product->updated_at->format('d/m/Y H:i') }}</p>
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
                        <p class="font-medium text-sm font-mono">{{ $product->slug }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('image-preview-container');
    const previewImage = document.getElementById('image-preview');
    
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        });
    }
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const price = document.getElementById('price').value;
        const stock = document.getElementById('stock').value;
        
        if (parseFloat(price) < 0) {
            alert('El precio no puede ser negativo');
            e.preventDefault();
            return false;
        }
        
        if (parseInt(stock) < 0) {
            alert('El stock no puede ser negativo');
            e.preventDefault();
            return false;
        }
        
        return true;
    });
});
</script>
@endpush