<form method="POST" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('PUT')

    <h3 class="text-lg font-semibold text-gray-800">
        Cambiar contraseña
    </h3>

    <div>
        <label class="block text-sm font-medium text-gray-700">Contraseña actual</label>
        <input type="password" name="current_password"
               class="mt-1 w-full rounded-md border-gray-300" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
        <input type="password" name="password"
               class="mt-1 w-full rounded-md border-gray-300" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
        <input type="password" name="password_confirmation"
               class="mt-1 w-full rounded-md border-gray-300" required>
    </div>

    <div class="flex justify-end">
        <button type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Actualizar contraseña
        </button>
    </div>
</form>