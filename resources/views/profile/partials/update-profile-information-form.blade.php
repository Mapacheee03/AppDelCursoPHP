<form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('PATCH')

    <h3 class="text-lg font-semibold text-gray-800">
        Información personal
    </h3>

    <div>
        <label class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text"
               name="name"
               value="{{ old('name', auth()->user()->name) }}"
               class="mt-1 w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
               required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email"
               name="email"
               value="{{ old('email', auth()->user()->email) }}"
               class="mt-1 w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
               required>
    </div>

    <div class="flex justify-end">
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar cambios
        </button>
    </div>
</form>