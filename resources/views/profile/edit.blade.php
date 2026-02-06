@extends('layouts.app')

@section('title', 'Mi perfil')

@section('header', 'Mi perfil')
@section('subheader', 'Administra tu información personal')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">

    {{-- TARJETA PERFIL --}}
    <div class="bg-white rounded-xl shadow-sm border p-6 flex items-center space-x-6">
        <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center text-3xl font-bold text-blue-600">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                {{ auth()->user()->name }}
            </h2>
            <p class="text-gray-500">{{ auth()->user()->email }}</p>
            <p class="text-sm text-gray-400 mt-1">
                Miembro desde {{ auth()->user()->created_at->format('d/m/Y') }}
            </p>
        </div>
    </div>

    {{-- ALERTA --}}
    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORMULARIO --}}
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            Información personal
        </h3>

        <form method="POST" action="{{ route('profile.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Nombre
                </label>
                <input type="text" name="name"
                       value="{{ old('name', auth()->user()->name) }}"
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Correo electrónico
                </label>
                <input type="email" name="email"
                       value="{{ old('email', auth()->user()->email) }}"
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="md:col-span-2 flex justify-end">
                <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>

    {{-- ZONA PELIGRO --}}
    <div class="bg-white rounded-xl shadow-sm border border-red-200 p-6">
        <h3 class="text-lg font-semibold text-red-600 mb-2">
            Zona peligrosa
        </h3>
        <p class="text-sm text-gray-600 mb-4">
            Eliminar tu cuenta es una acción permanente.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <button onclick="return confirm('⚠️ ¿Seguro que deseas eliminar tu cuenta?')"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                Eliminar cuenta
            </button>
        </form>
    </div>

</div>
@endsection