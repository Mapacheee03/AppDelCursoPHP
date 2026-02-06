<form method="POST" action="{{ route('profile.destroy') }}"
      onsubmit="return confirm('¿Seguro que quieres eliminar tu cuenta? Esta acción no se puede deshacer.')">
    @csrf
    @method('DELETE')

    <h3 class="text-lg font-semibold text-red-600">
        Eliminar cuenta
    </h3>

    <p class="text-sm text-gray-600 mt-2">
        Esta acción eliminará tu cuenta de forma permanente.
    </p>

    <div class="mt-4">
        <button type="submit"
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Eliminar cuenta
        </button>
    </div>
</form>