@extends('layouts.app')

@section('title', 'Categorías - ' . config('app.name'))

@section('breadcrumbs')
<li class="flex items-center">
    <span class="text-gray-500">Categorías</span>
</li>
@endsection

@section('header', 'Lista de Categorías')
@section('subheader', 'Gestión de categorías de productos')

@section('content')

<!-- Estadísticas -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border rounded-lg p-4">
        <div class="text-sm text-gray-500">Total Categorías</div>
        <div class="text-2xl font-bold">{{ $categories->count() }}</div>
    </div>

    <div class="bg-white border rounded-lg p-4">
        <div class="text-sm text-gray-500">Activas</div>
        <div class="text-2xl font-bold text-green-600">
            {{ $categories->where('is_active', true)->count() }}
        </div>
    </div>

    <div class="bg-white border rounded-lg p-4">
        <div class="text-sm text-gray-500">Con Productos</div>
        <div class="text-2xl font-bold text-blue-600">
            {{ $categories->where('products_count', '>', 0)->count() }}
        </div>
    </div>

    <div class="bg-white border rounded-lg p-4">
        <div class="text-sm text-gray-500">Promedio Productos</div>
        <div class="text-2xl font-bold text-purple-600">
            {{ $categories->count() ? round($categories->avg('products_count'), 1) : 0 }}
        </div>
    </div>
</div>

<!-- Botón -->
<div class="mb-6 flex justify-end">
    <a href="{{ route('categories.create') }}"
       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        Nueva Categoría
    </a>
</div>

<!-- Mensajes -->
@if(session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
    {{ session('error') }}
</div>
@endif

<!-- Tabla -->
<div class="overflow-x-auto border rounded-lg">
<table class="min-w-full divide-y">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left">Categoría</th>
            <th class="px-6 py-3 text-left">Productos</th>
            <th class="px-6 py-3 text-left">Estado</th>
            <th class="px-6 py-3 text-left">Creado</th>
            <th class="px-6 py-3 text-left">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4">
                <div class="font-semibold">{{ $category->name }}</div>
                <div class="text-sm text-gray-500">
                    {{ \Illuminate\Support\Str::limit($category->description, 60) }}
                </div>
                <code class="text-xs text-gray-400">{{ $category->slug }}</code>
            </td>

            <td class="px-6 py-4">
                {{ $category->products_count }}
            </td>

            <td class="px-6 py-4">
                @if($category->is_active)
                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded">Activa</span>
                @else
                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded">Inactiva</span>
                @endif
            </td>

            <td class="px-6 py-4">
                {{ $category->created_at->format('d/m/Y') }}
            </td>

            <td class="px-6 py-4">
                <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600">Editar</a>

                <form action="{{ route('categories.destroy', $category->id) }}"
                      method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('¿Eliminar categoría?')"
                            class="text-red-600 ml-2">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center py-10 text-gray-400">
                No hay categorías
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection