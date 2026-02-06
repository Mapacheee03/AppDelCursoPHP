<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Muestra el dashboard principal
     */
    public function index()
    {
        $datos = [
            'titulo' => 'Mi Dashboard',
            'mensaje' => 'Bienvenido a tu panel de control',
            'usuario' => 'Desarrollador',
            'fecha' => now()->format('d/m/Y'),
        ];
        
        // Retorna una vista (la crearemos en el siguiente paso)
        return view('dashboard', $datos);
    }
}