@extends('layouts.app')

@section('title', 'Papelera de Reciclaje - ' . config('app.name'))

@section('breadcrumbs')
    <li class="flex items-center">
        <a href="{{ route('products.index') }}" class="text-blue-500 hover:text-blue-700">Productos</a>
        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </li>
    <li class="flex items-center">
        <span class="text-gray-500">Papelera de Reciclaje</span>
    </li>
@endsection

@section('header', 'Papelera de Reciclaje')
@section('subheader', 'Productos eliminados recientemente')

@section('content')

<!-- Alerta -->
<div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
    <div class="flex">
        <svg class="w-5 h-5 text-yellow-500 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92z" clip-rule="evenodd"/>
        </svg>
        <div>
            <h4 class="font-medium text-yellow-800">Atención</h4>
            <p class="mt-1 text-sm text-yellow-700">
                Los productos eliminados pueden restaurarse o eliminarse permanentemente.
            </p>
        </div>
    </div>
</div>

<!-- Volver -->
<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('products.index') }}"
       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 flex items-center">
        ← Volver a Productos
    </a>

    <div class="text-sm text-gray-600">
        <span class="font-medium">{{ $products->total() }}</span> productos eliminados
    </div>
</div>

@if($products->count())

<div class="overflow-x-auto border rounded-lg">
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Producto</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoría</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Eliminado</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">

        @foreach($products as $product)
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4">
                <div class="font-medium">{{ $product->name }}</div>
                <div class="text-sm text-gray-500">
                    Precio: ${{ number_format($product->price, 2) }} | Stock: {{ $product->stock }}
                </div>
            </td>

            <td class="px-6 py-4">
                @if($product->category)
                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded">
                        {{ $product->category->name }}
                    </span>
                @else
                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded">
                        Sin categoría
                    </span>
                @endif
            </td>

            <td class="px-6 py-4">
                <div>{{ $product->deleted_at->format('d/m/Y H:i') }}</div>
                <div class="text-xs text-gray-500">{{ $product->deleted_at->diffForHumans() }}</div>
            </td>

            <td class="px-6 py-4">
                <div class="flex space-x-2">

                    <!-- RESTAURAR -->
                    <form action="{{ route('products.restore', $product->id) }}" method="POST">
                        @csrf
                        <button onclick="return confirm('¿Restaurar este producto?')"
                                class="text-green-600 hover:text-green-800">
                            Restaurar
                        </button>
                    </form>

                    <!-- ELIMINAR DEFINITIVO -->
                    <form action="{{ route('products.force-delete', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('⚠️ Esta acción es permanente')"
                                class="text-red-600 hover:text-red-800">
                            Eliminar
                        </button>
                    </form>

                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
</div>

@if($products->hasPages())
<div class="mt-6">
    {{ $products->links() }}
</div>
@endif

@else

<div class="text-center py-12 text-gray-500">
    La papelera está vacía.
</div>

@endif

@endsection