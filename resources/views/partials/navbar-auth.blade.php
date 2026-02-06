<div class="flex items-center space-x-4">
    <!-- Notificaciones -->
    <div class="relative" x-data="{ notificationsOpen: false }">
        <button @click="notificationsOpen = !notificationsOpen" 
                @click.away="notificationsOpen = false"
                class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-colors relative focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                :class="{ 'bg-gray-100': notificationsOpen }">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full text-xs text-white flex items-center justify-center font-semibold">
                3
            </span>
        </button>

        <!-- Dropdown de notificaciones -->
        <div x-show="notificationsOpen" 
             x-cloak
             class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50 border border-gray-200"
             style="display: none;">
            <div class="p-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Notificaciones</h3>
            </div>
            <div class="p-4">
                <p class="text-gray-600 text-sm">No hay notificaciones nuevas.</p>
            </div>
        </div>
    </div>

    <!-- Dropdown de usuario -->
    <div class="relative" x-data="{ userOpen: false }">
        <button @click="userOpen = !userOpen" 
                @click.away="userOpen = false"
                class="flex items-center space-x-2 focus:outline-none"
                :class="{ 'bg-gray-100': userOpen }">
            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                <span class="text-blue-600 font-semibold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>
            </div>
            <span class="hidden md:block text-sm font-medium text-gray-700">
                {{ Auth::user()->name }}
            </span>
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div x-show="userOpen" 
             x-cloak
             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 border border-gray-200"
             style="display: none;">
            <a href="{{ route('profile.edit') }}" 
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Mi perfil
            </a>
            <a href="{{ route('dashboard') }}" 
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Dashboard
            </a>
            <div class="border-t my-1"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</div>