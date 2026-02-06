<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Panel de administración principal
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'latest_users' => User::latest()->take(5)->get(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Gestión de usuarios
     */
    public function users()
    {
        $users = User::withCount('products')->latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    /**
     * Configuración del sistema
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Reportes
     */
    public function reports()
    {
        return view('admin.reports');
    }

    /**
     * Editar usuario
     */
    public function editUser(User $user)
    {
        return view('admin.users-edit', compact('user'));
    }

    /**
     * Actualizar usuario
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'boolean',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')
            ->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Eliminar usuario
     */
    public function deleteUser(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'Usuario eliminado correctamente');
    }

    /**
     * Métodos de API
     */
    public function apiIndex()
    {
        return response()->json(Product::all());
    }

    public function apiShow($id)
    {
        return response()->json(Product::findOrFail($id));
    }
}