<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

// Rutas públicas (sin autenticación)
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/acerca', function () {
    return view('about');
})->name('about');

// Ruta pública con parámetro
Route::get('/saludo/{nombre}', function ($nombre) {
    return '¡Hola ' . $nombre . '! Bienvenido a Laravel.';
});

// Rutas de autenticación (generadas por Breeze)
require __DIR__ . '/auth.php';

// Rutas protegidas (requieren autenticación)
Route::middleware(['auth'])->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');

    // Perfil de usuario (requiere email verificado si usas esa función)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para Productos (CRUD completo)

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/trashed', [ProductController::class, 'trashed'])->name('trashed');
        Route::post('/{product}/restore', [ProductController::class, 'restore'])->name('restore');
        Route::delete('/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('force-delete');
    });
    Route::resource('products', ProductController::class);

    // Rutas para Categorías (CRUD completo)
    Route::resource('categories', CategoryController::class);


    // Ruta con vista personalizada
    Route::get('/mi-vista', function () {
        return view('mi-vista-personalizada');
    })->name('mi-vista');

    // Grupo de rutas con prefijo admin
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');

        // Rutas para gestionar usuarios (si las implementas)
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    });

    // Rutas adicionales para pruebas - CORREGIDO
    Route::get('/test-auth', function () {
        // Usando el facade Auth en lugar del helper auth()
        $user = Auth::user();
        if ($user) {
            return '✅ Ruta protegida - Usuario autenticado: ' . $user->name;
        }
        return '❌ Usuario no autenticado';
    })->name('test.auth');
});

// Rutas de API (si las necesitas)
Route::prefix('api')->group(function () {
    Route::get('/products', [ProductController::class, 'apiIndex']);
    Route::get('/products/{id}', [ProductController::class, 'apiShow']);
});

// Ruta para verificar estado de la aplicación
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'laravel_version' => app()->version(),
        'php_version' => PHP_VERSION,
    ]);
});


// Ruta de fallback (404)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
